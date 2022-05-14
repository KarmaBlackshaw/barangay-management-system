<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }
    
	$title 	= $conn->real_escape_string($_POST['chair']);

    if(!empty($title)){

        $insert  = "INSERT INTO tblchairmanship (`title`) VALUES ('$title')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Chairmanship added!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    header("Location: ../chairmanship.php");

	$conn->close();