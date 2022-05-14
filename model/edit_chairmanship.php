<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$chair 	= $conn->real_escape_string($_POST['chair']);
    $id 	= $conn->real_escape_string($_POST['id']);

	if(!empty($id)){

		$query 		= "UPDATE tblchairmanship SET `title` = '$chair' WHERE id=$id;";	
		$result 	= $conn->query($query);

		if($result === true){
            
			$_SESSION['message'] = 'Title has been updated!';
			$_SESSION['success'] = 'success';

		}else{
			$_SESSION['message'] = 'Somethin went wrong!';
			$_SESSION['success'] = 'danger';
		}

	}else{
		$_SESSION['message'] = 'No title ID found!';
		$_SESSION['success'] = 'danger';
	}

    header("Location: ../chairmanship.php");

	$conn->close();