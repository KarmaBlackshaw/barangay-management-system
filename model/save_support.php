<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

	$name 	    = $conn->real_escape_string($_POST['name']);
	$email 	    = $conn->real_escape_string($_POST['email']);
    $number 	= $conn->real_escape_string($_POST['number']);
	$subject 	= $conn->real_escape_string($_POST['subject']);
    $message 	= $conn->real_escape_string($_POST['message']);

    if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){

        $insert  = "INSERT INTO tbl_support (`name`, email, `number`, `subject`, `message`) VALUES ('$name', '$email', '$number', '$subject', '$message')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Support sent!';
            $_SESSION['success'] = 'success';

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';
    }

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

	$conn->close();