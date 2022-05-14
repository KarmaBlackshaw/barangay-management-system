<?php 
    $query = "SELECT * FROM tblbrgy_info";
    $result = $conn->query($query);
	$row = $result->fetch_assoc();

	if($row){
		$province = $row['province'];
		$town	= $row['town'];
		$brgy 		= $row['brgy_name'];
		$number =  $row['number'];
		$city_logo 	= $row['city_logo'];
		$brgy_logo		= $row['brgy_logo'];
		$db_txt		= $row['text'];
		$db_img		= $row['image'];
	}

	$pos_q = "SELECT * FROM tblposition ORDER BY `order` ASC";
    $pos_r = $conn->query($pos_q);

    $position = array();
	while($row = $pos_r->fetch_assoc()){
		$position[] = $row; 
	}

	$chair_q = "SELECT * FROM tblchairmanship";
	$res_q = $conn->query($chair_q);

	$chair = array();
	while($row = $res_q->fetch_assoc()){
		$chair[] = $row; 
	}
    
?>