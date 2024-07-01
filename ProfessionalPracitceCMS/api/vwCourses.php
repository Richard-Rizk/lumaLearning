<?php 
require('localConnection.php');

$status = $_REQUEST['status'];

if ($status == 'coursesByTRainer') {
    // Check if TrainerId is set in the request
    if (isset($_REQUEST['TrainerId'])) {
        $TrainerId = $_REQUEST['TrainerId'];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM Course WHERE TrainerId = ?";
        $params = array($TrainerId);
        $result = sqlsrv_query($conn, $query, $params);

        if ($result === false) {
            // Handle SQL query execution error
            die(print_r(sqlsrv_errors(), true));
        }

        $arr = array();
        while ($row = sqlsrv_fetch_Object($result)) {
            $arr[] = $row;
        }
        echo json_encode($arr);
    } else {
        // Handle case where TrainerId is not set
        echo json_encode(array('error' => 'TrainerId is not set'));
    }
} elseif ($status == 'allCourses') {
    // Retrieve all courses
    $query = "SELECT * FROM Course";
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => "static")) or die(print_r(sqlsrv_errors(), true)); 

    $arr = array();
			
    while ($row = sqlsrv_fetch_Object($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} elseif ($status == 'update') {
    // Check if required parameters are set
    if (isset($_REQUEST['CourseId']) && isset($_REQUEST['CourseName']) && isset($_REQUEST['CourseDesc']) && isset($_REQUEST['Price'])) {
        // Retrieve parameters from the request
        $CourseId = $_REQUEST['CourseId'];
        $CourseName = $_REQUEST['CourseName'];
        $CourseDesc = $_REQUEST['CourseDesc'];
        $Price = $_REQUEST['Price'];

        // Use prepared statements to prevent SQL injection
        $query = "UPDATE Course SET CourseName = ?, CourseDesc = ?, Price = ? WHERE CourseId = ?";
        $params = array($CourseName, $CourseDesc, $Price, $CourseId);
        $result = sqlsrv_query($conn, $query, $params);

        if ($result === false) {
            // Handle SQL query execution error
            die(print_r(sqlsrv_errors(), true));
        }

        echo json_encode(array('success' => 'Course updated successfully'));
    } else {
        // Handle case where required parameters are not set
        echo json_encode(array('error' => 'Required parameters are missing'));
    }
}
elseif ($status == 'new') {
    // Check if required parameters are set for adding a new course
    if (isset($_REQUEST['TrainerId']) && isset($_REQUEST['CourseName']) && isset($_REQUEST['CourseDesc']) && isset($_REQUEST['Price'])) {
        // Retrieve parameters from the request
        $TrainerId = $_REQUEST['TrainerId'];
        $CourseName = $_REQUEST['CourseName'];
        $CourseDesc = $_REQUEST['CourseDesc'];
        $Price = $_REQUEST['Price'];

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO Course (TrainerId, CourseName, CourseDesc, Price) VALUES (?, ?, ?, ?)";
        $params = array($TrainerId, $CourseName, $CourseDesc, $Price);
        $result = sqlsrv_query($conn, $query, $params);

        if ($result === false) {
            // Handle SQL query execution error
            die(print_r(sqlsrv_errors(), true));
        }

        echo json_encode(array('success' => 'New course added successfully'));
    } else {
        // Handle case where required parameters are not set for adding a new course
        echo json_encode(array('error' => 'Required parameters are missing for adding a new course'));
    }
}
elseif ($status == 'latestCoursesByStartDate') {
    // Retrieve the latest 3 courses by StartDate
    $query = "SELECT TOP 3 * FROM Course ORDER BY StartDate DESC";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        // Handle SQL query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    $arr = array();
    while ($row = sqlsrv_fetch_Object($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} 
elseif ($status == 'highestViews') {
    // Retrieve the latest 3 courses by StartDate
    $query = "SELECT TOP 3 * FROM Course ORDER BY NbofViews DESC";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        // Handle SQL query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    $arr = array();
    while ($row = sqlsrv_fetch_Object($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} 
elseif ($status == 'random') {
    // Retrieve the latest 3 courses by StartDate
    $query = "SELECT TOP 3 * FROM Course ORDER BY NEWID()";
    $result = sqlsrv_query($conn, $query);

    if ($result === false) {
        // Handle SQL query execution error
        die(print_r(sqlsrv_errors(), true));
    }

    $arr = array();
    while ($row = sqlsrv_fetch_Object($result)) {
        $arr[] = $row;
    }
    echo json_encode($arr);
} 










else {
    // Handle unknown status
    echo json_encode(array('error' => 'Unknown status'));
}

?>
