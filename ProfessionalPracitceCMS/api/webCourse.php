<?php require('localconnection.php') ;  ?><?php 
		
	$status =  $_REQUEST["status"];
		
	if ($status == "one" )
	{
		$id = $_REQUEST["id"];
		$query = "select * from RT_Course where CourseID=$id"   ;
		$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;
			
		$arr = array();
		
		while ($row =  sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		echo json_encode($arr);
		return;
	}
	
	if ($status == "data" )
	{
		$query = "select * from RT_Course " ;
		$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;
			
		$arr = array();
		
		while ($row =  sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		$response["data"] = $arr ;
		echo json_encode($response);
		return;
	}

	if ($status == "select" )
	{
		$query = "select * from RT_Course " ;
		$result=  sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
			
		$arr = array();
		
		while ($row = sqlsrv_fetch_Object($result))
		{
			$arr[] = $row;
		}
		echo json_encode($arr);
		return;
	}
	if ($status == "selectActive" )
	{
		$query = "select * from RT_Course where IsActive = 1" ;
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
		$query = "delete from RT_Course where CourseID=$id" ;
		$result= sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ;  
		echo json_encode("Record has been deleted.");
		return ; 
	}
	
	$Title= addslashes($_REQUEST["Title"]);
	$CourseDescr= addslashes($_REQUEST["CourseDescr"]);
	// $StartDate= addslashes($_REQUEST["StartDate"]);
	// $StopDate= addslashes($_REQUEST["StopDate"]);
	$CoursePortalID= addslashes($_REQUEST["CoursePortalID"]);
	$TrainerID= addslashes($_REQUEST["TrainerID"]);
	// $IsActive= isset($_REQUEST['IsActive'])? 1:0;
	$IsActive= $_REQUEST['IsActive'];
	$CoursePrice= addslashes($_REQUEST["CoursePrice"]);
	
	if ($status == "new")
	{
		$query = "insert into RT_Course  (Title,CourseDescr, CoursePortalID,TrainerID,IsActive, CoursePrice)  values (N'$Title',N'$CourseDescr','$CoursePortalID','$TrainerID','$IsActive', $CoursePrice);select SCOPE_IDENTITY()";
		// $query = "insert into RT_Course  (Title,CourseDescr,StartDate,StopDate,CoursePortalID,TrainerID,IsActive, CoursePrice)  values ('$Title','$CourseDescr','$StartDate','$StopDate','$CoursePortalID','$TrainerID','$IsActive', $CoursePrice);select SCOPE_IDENTITY()";
		$result = sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		sqlsrv_next_result($result);
		sqlsrv_fetch($result);
        $id = sqlsrv_get_field($result , 0);
		$arr['CourseID'] = $id;
		echo json_encode($arr);
		return;
	} 
					
	if ($status == "update")
	{ 
		$result = "";
		$id = $_REQUEST["id"];
		$query = "update RT_Course set Title=N'$Title',CourseDescr=N'$CourseDescr', CoursePortalID='$CoursePortalID',TrainerID='$TrainerID',isActive='$IsActive', CoursePrice = $CoursePrice where CourseID = $id";
		// $query = "update RT_Course set Title='$Title',CourseDescr='$CourseDescr',StartDate='$StartDate',StopDate='$StopDate',CoursePortalID='$CoursePortalID',TrainerID='$TrainerID',isActive='$IsActive', CoursePrice = $CoursePrice where CourseID = $id";
		sqlsrv_query($conn, $query , array() , array("Scrollable" => "static")) or  die( print_r( sqlsrv_errors(), true)) ; 
		echo json_encode($result);
	}
					 
?>