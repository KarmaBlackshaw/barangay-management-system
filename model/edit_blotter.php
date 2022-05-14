<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
    $id 	= $conn->real_escape_string($_POST['id']);
	$complainant    = $conn->real_escape_string($_POST['complainant']);
	$respondent 	= $conn->real_escape_string($_POST['respondent']);
    $victim 	    = $conn->real_escape_string($_POST['victim']);
	$type 	        = $conn->real_escape_string($_POST['type']);
    $location 	    = $conn->real_escape_string($_POST['location']);
    $date           = $conn->real_escape_string($_POST['date']);
	$time 	        = $conn->real_escape_string($_POST['time']);
    $status 	    = $conn->real_escape_string($_POST['status']);
    $details 	    = $conn->real_escape_string($_POST['details']);

	if(!empty($id)){

		$query 		= "UPDATE tblblotter SET `complainant`='$complainant', `respondent`='$respondent', `victim`='$victim',`type`='$type', `location`='$location', `date`='$date', 
                        `time`='$time', `status`='$status', `details`='$details' WHERE id=$id;";	
		$result 	= $conn->query($query);

		if($result === true){
            
			$_SESSION['message'] = 'Blotter details has been updated!';
			$_SESSION['success'] = 'success';

		}else{

			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}

	}else{
		$_SESSION['message'] = 'No Blotter ID found!';
		$_SESSION['success'] = 'danger';
	}

    header("Location: ../blotter.php");

	$conn->close();