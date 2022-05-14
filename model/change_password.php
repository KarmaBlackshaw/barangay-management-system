<?php 
	include '../server/server.php';

    $username 	= $conn->real_escape_string($_POST['username']);
	$cur_pass 	= sha1($conn->real_escape_string($_POST['cur_pass']));
	$new_pass 	= sha1($conn->real_escape_string($_POST['new_pass']));
    $con_pass 	= sha1($conn->real_escape_string($_POST['con_pass']));

	if(!empty($username)){

        if($new_pass==$con_pass){

            $check = "SELECT * FROM tbl_users WHERE username='$username' AND `password`='$cur_pass'";
            $res = $conn->query($check);

            if($res->num_rows){

                $query 		= "UPDATE tbl_users SET `password`='$new_pass' WHERE username='$username'";	
                $result 	= $conn->query($query);

                if($result === true){
                    
                    $_SESSION['message'] = 'Password has been updated!';
                    $_SESSION['success'] = 'success';

                }else{

                    $_SESSION['message'] = 'Somethin went wrong!';
                    $_SESSION['success'] = 'danger';
                }
            }else{
                $_SESSION['message'] = 'Current Password is incorrect!';
                $_SESSION['success'] = 'danger';
            }

        }else{
            $_SESSION['message'] = 'Password did not match!';
		    $_SESSION['success'] = 'danger';
        }
        

	}else{
		$_SESSION['message'] = 'No Username found!';
		$_SESSION['success'] = 'danger';
	}

    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

	$conn->close();