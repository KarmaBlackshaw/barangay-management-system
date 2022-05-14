<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$precinct 	= $conn->real_escape_string($_POST['precinct']);
	$details 	= $conn->real_escape_string($_POST['details']);
    $id 	    = $conn->real_escape_string($_POST['id']);

    if(!empty($precinct)){

        $query 		= "UPDATE tblprecinct SET `precinct` = '$precinct', `details`='$details' WHERE id=$id;";	
		$result 	= $conn->query($query);

        if($result === true){
            $_SESSION['message'] = 'Precinct has been updated!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'No Precinct ID found!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../precinct.php");

	$conn->close();