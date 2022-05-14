<?php 
	include '../server/server.php';

	if(!isset($_SESSION['username'])){
		if (isset($_SERVER["HTTP_REFERER"])) {
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
	}
	
	$province 	= $conn->real_escape_string($_POST['province']);
	$brgy 		= $conn->real_escape_string($_POST['brgy']);
	$town 		= $conn->real_escape_string($_POST['town']);
	$number 	= $conn->real_escape_string($_POST['number']);
	$db_txt 	= $conn->real_escape_string($_POST['db_msg']);
	$city_logo 	= $_FILES['city_logo']['name'];
	$brgy_logo 	= $_FILES['brgy_logo']['name'];
	$db_image 	= $_FILES['db_img']['name'];

	// change city_logo name
	$newC = date('dmYHis').str_replace(" ", "", $city_logo);
	// change brgy_logo name
	$newB = date('dmYHis').str_replace(" ", "", $brgy_logo);

	$newD = date('dmYHis').str_replace(" ", "", $db_image);

	// image file directory
  	$target = "../assets/uploads/".basename($newC);
	  // image file directory
  	$target1 = "../assets/uploads/".basename($newB);

	$target2 = "../assets/uploads/".basename($newD);

	if(!empty($brgy) && !empty($town)){

		if(!empty($city_logo) && !empty($brgy_logo) && !empty($db_image)){

			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt', `image`='$newD', city_logo='$newC', brgy_logo='$newB' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

				if(move_uploaded_file($_FILES['city_logo']['tmp_name'], $target)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}

				if(move_uploaded_file($_FILES['brgy_logo']['tmp_name'], $target1)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}

				if(move_uploaded_file($_FILES['db_img']['tmp_name'], $target2)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
			}
		}else if(!empty($city_logo) && !empty($brgy_logo) && empty($db_image)){

			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt', city_logo='$newC', brgy_logo='$newB' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

				if(move_uploaded_file($_FILES['city_logo']['tmp_name'], $target)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
				if(move_uploaded_file($_FILES['brgy_logo']['tmp_name'], $target1)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
			}

		}else if(!empty($city_logo) && empty($brgy_logo) && empty($db_image)){

			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt', city_logo='$newC' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

				if(move_uploaded_file($_FILES['city_logo']['tmp_name'], $target)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
			}

		}else if(empty($city_logo) && empty($brgy_logo) && !empty($db_image)){

			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt', `image`='$newD' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

				if(move_uploaded_file($_FILES['db_img']['tmp_name'], $target2)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
			}
		}else if(empty($city_logo) && !empty($brgy_logo) && !empty($db_image)){

			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt', `image`='$newD', brgy_logo='$newB' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

				if(move_uploaded_file($_FILES['brgy_logo']['tmp_name'], $target1)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
				if(move_uploaded_file($_FILES['db_img']['tmp_name'], $target2)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
			}
		}else if(empty($city_logo) && !empty($brgy_logo) && empty($db_image)){

			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt', brgy_logo='$newB' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

				if(move_uploaded_file($_FILES['brgy_logo']['tmp_name'], $target1)){

					$_SESSION['message'] = 'Barangay Info has been updated!';
					$_SESSION['success'] = 'success';
				}
			}
		}else{
			$query = "UPDATE tblbrgy_info SET province='$province', town='$town', brgy_name='$brgy', `number`='$number',`text`='$db_txt' WHERE id=1";

			if($conn->query($query) === true){

				$_SESSION['message'] = 'Barangay Info has been updated!';
				$_SESSION['success'] = 'success';

			}else{
				$_SESSION['message'] = 'Something went wrong!';
				$_SESSION['success'] = 'danger';
			}
		}

	

	}else{

		$_SESSION['message'] = 'Please complete the form!';
		$_SESSION['success'] = 'danger';
	}

	if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

	$conn->close();

