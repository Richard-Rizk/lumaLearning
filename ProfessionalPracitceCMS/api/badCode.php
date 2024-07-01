<?php
require('localConnection.php');
header('Content-Type: application/json');

$status = $_REQUEST['status'];

if ($status == "data") {
    $query = "SELECT * FROM [User] WHERE UserType = 'tr'";
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));

    $arr = array();
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $arr[] = $row;
    }
    echo json_encode(array("data" => $arr));
    return;
}
if ($status == "delete") {
    $id = $_REQUEST['id'];
    $query = "DELETE FROM [User] WHERE UserID=$id";
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
    echo json_encode("Record has been deleted.");
    return;
}

$FirstName = addslashes($_REQUEST["FirstName"]);
$LastName = addslashes($_REQUEST["LastName"]);
$Tel = addslashes($_REQUEST["Tel"]);
$Email = addslashes($_REQUEST["Email"]);
$IsActive = addslashes($_REQUEST["IsActive"]);

$UserType = 'tr';

if ($status == "new") {
    $query = "INSERT INTO [User] (FirstName, LastName, Tel, Email, IsActive, UserType) VALUES (N'$FirstName', N'$LastName', '$Tel', '$Email', '$IsActive', '$UserType'); SELECT SCOPE_IDENTITY() as UserID";
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
    $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    $id = $row['UserID'];
    $response = array("UserID" => $id);
    echo json_encode($response);
    return;
}

if ($status == "update") {
    $id = $_REQUEST['id'];
    $query = "UPDATE [User] SET FirstName=N'$FirstName', LastName=N'$LastName', Tel='$Tel', Email='$Email', IsActive='$IsActive' WHERE UserID=$id";
    sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
    echo json_encode("Updated successfully");
    return;
}
?>


<!-- old code -->
<?php require('localConnection.php') ;  ?><?php 
		
	$status =  $_REQUEST["status"];
	
	if ($status == "one" )
	{
		$id = $_REQUEST["id"];
		$query = "SELECT * from [tbluser] where UserID=$id"   ;
			$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;
			
		$arr = array();
		
		while ($row =  sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		echo json_encode($arr);
		return;
	}
	
	$status =  $_REQUEST["data"];
    // Assuming $conn is your database connection

    // Define the query to select users with UserType 'tr'
	
		$query = "SELECT * from [tbluser] WHERE UserType = 'tr'";

		// Execute the query
		$result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
	
		// Fetch results into an array
		$arr = array();
		while ($row = sqlsrv_fetch_Object($result)) {
			$arr[] = $row;
		}
	
		// Encode the array as JSON and echo
		echo json_encode($arr);
	

	if ($status == "select" )
		{
			$query = "SELECT * from [tbluser] " ;
			$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
				
			$arr = array();
			
			while ($row = sqlsrv_fetch_Object($result))
			{
				$arr[] = $row;
			}
			echo json_encode($arr);
			return;
		}
	if ($status == "selectUserNames" )
		{
			$query = "SELECT UserName from [tbluser]" ;
			$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
				
			$arr = array();
			
			while ($row = sqlsrv_fetch_Object($result))
			{
				$arr[] = $row;
			}
			echo json_encode($arr);
			return;
		}

	if($status=="delete") 
		{
			$id = $_REQUEST["id"];
			$query = "DELETE from [tbluser] where UserID=$id" ;
				$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;  
				
			echo json_encode("Record has been deleted.");
			return ; 
		}
	if ($status == 'rmvImg'){
		$id = $_REQUEST["id"];
		$query = "SELECT Photo from [tbluser] where UserID = $id";
		$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		sqlsrv_fetch($result);
        $fileToDelete = sqlsrv_get_field($result , 0);
		if($fileToDelete){
			$query = "update tbluser set Photo = null where UserID = $id";
			$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
			if (file_exists($fileToDelete)) {
				// Attempt to delete the file
				if (unlink($fileToDelete)) {
					$msg = "File deleted successfully.";
				} else {
					$msg = "Error deleting the file.";
				}
			} else {
				$msg = "File does not exist.";
			}
		}else{
			$msg = "No file to delete";
		}
		echo json_encode($msg);
		return;
	}

	if ($status == "updateCardinantials")
	{ 
		$arr = [];
		$id = $_REQUEST["id"];
		$userName = $_REQUEST["UserName"];
		$password = $_REQUEST["Password"];
		$query = "update tbluserset UserName = '$userName', password = '$password' where UserID = $id";
		sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		$arr['success'] = true;
		echo json_encode($arr);
		return;
	}
	
	$FirstName= addslashes($_REQUEST["FirstName"]);
	// $FatName= addslashes($_REQUEST["FatName"]);
	// $LName= addslashes($_REQUEST["LName"]);
	// $DOB= addslashes($_REQUEST["DOB"]);
	$Tel= addslashes($_REQUEST["Tel"]);
	$Email = addslashes($_REQUEST["Email"]);
	// $JoinDate= addslashes($_REQUEST["JoinDate"]);
	$IsActive= isset($_REQUEST['IsActive'])?1:0;
	$path_filename_ext = '';
	$UserType = addslashes($_REQUEST['UserType']);
	if($UserType == 'tr'){
		$target_dir = "upload/trainers/";
	}elseif ($UserType == 'te') {
		$target_dir = "upload/trainees/";
	}
	
	
	if ($status == "new")
	{
		$arr = [];
		
		//  if (isset($_FILES["Photo"])){
		// 	if (($_FILES["Photo"]["name"]!="")){
				
		// 		$file = $_FILES["Photo"]["name"];
		// 		$path = pathinfo($file);
		// 		$filename = $path["filename"];
		// 		$ext = $path["extension"];
		// 		$temp_name = $_FILES["Photo"]["tmp_name"];
		// 		$path_filename_ext = $target_dir.$filename.".".$ext;
			
		// 		if (file_exists($path_filename_ext)) {
		// 				$arr['msg'] = "Sorry, file already exists.";
		// 		}else{
		// 				move_uploaded_file($temp_name,$path_filename_ext);
		// 				$arr['msg'] = "File Uploaded Successfully";
		// 		}
		// 	}
		//	$query = "insert into tbluser (FName, FatName, LName, DOB, Phone, Email, Photo,JoinDate, IsActive, UserType)  values (N'$FName', N'$FatName', N'$LName', N'$DOB', '$Phone', '$Email', '$path_filename_ext','$JoinDate','$IsActive', '$UserType');select SCOPE_IDENTITY()";
		// }else{
		 	//$query = "insert into tbluser (FName, FatName, LName, DOB, Phone, Email, JoinDate, IsActive, UserType)  values (N'$FName', N'$FatName', N'$LName', N'$DOB' '$Phone', '$Email', '$JoinDate','$IsActive', 'tr');select SCOPE_IDENTITY()";
		// }
			
		$result = sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		sqlsrv_next_result($result);
		sqlsrv_fetch($result);
        $id = sqlsrv_get_field($result , 0);
		$arr['UserID'] = $id;
		echo json_encode($arr);
		return;
	} 
				
	if ($status == "update")
	{ 
		$arr = [];
		$id = $_REQUEST["id"];
		// if (isset($_REQUEST["Photo"])){
			// if (($_FILES["Photo"]["name"]!="")){
			// 	$target_dir = "upload/trainers/";
			// 	$file = $_FILES["Photo"]["name"];
			// 	$path = pathinfo($file);
			// 	$filename = $path["filename"];
			// 	$ext = $path["extension"];
			// 	$temp_name = $_FILES["Photo"]["tmp_name"];
			// 	$path_filename_ext = $target_dir.$filename.".".$ext;
			
			// 	if (file_exists($path_filename_ext)) {
			// 			$arr['msg'] = "Sorry, file already exists.";
			// 	}else{
			// 			move_uploaded_file($temp_name,$path_filename_ext);
			// 			$arr['msg'] = "File Uploaded Successfully";
			// 	}
			// }
			// if ($path_filename_ext!= ""){
			// 	$query = "update tbluserset FName=N'$FName',LName=N'$LName', Phone = '$Phone', Email = '$Email', Photo='$path_filename_ext',JoinDate='$JoinDate',IsActive='$IsActive' where UserID = $id";
			// }
			// else
			// {
			// 	$query = "update tbluserset FName=N'$FName',LName=N'$LName', Phone = '$Phone', Email = '$Email', JoinDate='$JoinDate',IsActive='$IsActive' where UserID = $id";
			// }
		// }else{
		// 	$query = "update tbluserset FName=N'$FName',LName=N'$LName', Phone = '$Phone', Email = '$Email', JoinDate='$JoinDate',IsActive='$IsActive' where UserID = $id";
		// }
		$arr['success'] = true;
		sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		echo json_encode($arr);
	}
					
?>
						
