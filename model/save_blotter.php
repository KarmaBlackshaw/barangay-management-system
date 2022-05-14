<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$complainant    = $conn->real_escape_string($_POST['complainant']);
	$respondent 	= $conn->real_escape_string($_POST['respondent']);
    $victim 	    = $conn->real_escape_string($_POST['victim']);
	$type 	        = $conn->real_escape_string($_POST['type']);
    $location 	    = $conn->real_escape_string($_POST['location']);
    $date           = $conn->real_escape_string($_POST['date']);
	$time 	        = $conn->real_escape_string($_POST['time']);
    $status 	    = $conn->real_escape_string($_POST['status']);
    $details 	    = $conn->real_escape_string($_POST['details']);

    if(!empty($complainant) && !empty($respondent) && !empty($victim) && !empty($type) && !empty($location) && !empty($date) && !empty($time) && !empty($status) && !empty($details)){

        $insert  = "INSERT INTO tblblotter (`complainant`, `respondent`, `victim`, `type`, `location`,`date`, `time`, `details`, `status`) 
                    VALUES ('$complainant', '$respondent','$victim', '$type','$location','$date', '$time','$details', '$status')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Blotter added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../blotter.php");

	$conn->close();