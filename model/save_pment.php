<?php 
	include('../server/server.php');

    if(!isset($_SESSION['username'])){
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    $user           = $_SESSION['username'];
    $name           = $conn->real_escape_string($_POST['name']);
	$amount 	    = $conn->real_escape_string($_POST['amount']);
    $date           = $conn->real_escape_string($_POST['date']);
	$details 	    = $conn->real_escape_string($_POST['details']);

    if(!empty($user) && !empty($name)){

        $insert  = "INSERT INTO tblpayments (`details`,`amounts`, `date`, `user`, `name`) VALUES ('$details', $amount, '$date', '$user',' $name')";
        $result  = $conn->query($insert);

        if($result === true){
            $_SESSION['message'] = 'Payment has been saved!';
            $_SESSION['success'] = 'success';

            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"].'&closeModal');
            }

        }else{
            $_SESSION['message'] = 'Something went wrong!';
            $_SESSION['success'] = 'danger';
            
            if (isset($_SERVER["HTTP_REFERER"])) {
                header("Location: " . $_SERVER["HTTP_REFERER"]);
            }
        }

    }else{

        $_SESSION['message'] = 'Please fill up the form completely!';
        $_SESSION['success'] = 'danger';

        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }



	$conn->close();