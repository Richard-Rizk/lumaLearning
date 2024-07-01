<?php
require('localConnection.php');
header('Content-Type: application/json');

$status = $_REQUEST['status'];

if ($status == "data") {
    $query = "SELECT * FROM [tbluser] WHERE UserType = 'tr'";
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
    $query = "DELETE FROM [tbluser] WHERE userID=$id";
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
    $query = "INSERT INTO [tbluser] (FirstName,LastName, Tel, Email,UserType, IsActive) VALUES (N'$FirstName',N'$LastName', '$Tel', '$Email','$UserType','$IsActive'); SELECT SCOPE_IDENTITY() as userID";
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
    $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC());
    $id = $row['id'];
    $response = array("userID" => $id);
    echo json_encode($response);
    return;
}

if ($status == "update") {
    $id = $_REQUEST['UserId'];
   // echo ($id);
    $query = "UPDATE [tbluser] SET FirstName=N'$FirstName', LastName=N'$LastName', Tel=N'$Tel', Email=N'$Email', IsActive='$IsActive' WHERE UserId=$id";
    sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true));
    echo json_encode("Updated successfully");
   
    return;
}
?>
