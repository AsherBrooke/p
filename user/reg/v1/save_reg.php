<?php
	header("Content-Type: application/json");
	include('data.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้
	//สร้างตัวแปรเก็บค่าที่รับมาจากฟอร์ม

	date_default_timezone_set('Asia/Bangkok');

	$username = $_POST["username"];
	$password = $_POST["password"];
	$repassword = $_POST["repassword"];
	$date = date('Y-m-d H:i:s');
	// $regurl = $burl . "reg";
	// $viewurl = $burl . "content/view";

	// if ($_POST["password"] !=  $_POST["repassword"]) {
	//   $scr =  '<script type="text/javascript">';
	//   $scr .=  'window.alert("Password นี้มีคนใช้ไปเเล้ว");';
	//   $scr .= '</script>';
	// 	echo $scr;
	// 	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=http://www.localhost/reg">';
	// 	exit;
	// }

	// ชุกตรวจสอบ
	// $check = 'false';
	$sqlget = "SELECT * FROM users";
    $result = $con->query($sqlget);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if ($row["username"] == $username) {
				// $scr =  '<script type="text/javascript">';
			  // $scr .=  'window.alert("user ซ้ำ");';
			  // $scr .= '</script>';
					echo json_encode(['status' => 'error', 'message' => 'usernameซ้ำ']);
					exit;
			} elseif ($_POST["password"] != $_POST["repassword"]) {
				// $scr =  '<script type="text/javascript">';
			  // $scr .=  'window.alert("Password ไม่ตรงกัน");';
			  // $scr .= '</script>';
					echo json_encode(['status' => 'error', 'message' => 'Password ไม่ตรงกัน']);;
					$check = 'false';
			} else {
				$check = 'true';
			}
		}
	}

	if ($check == 'false') {
		// echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL='. $regurl .'">';
	    echo json_encode(['status' => 'error', 'message' => 'false']);
			exit;
	}

	$sql = "INSERT INTO users (id, username, password, group)
	 				VALUES('', '". $username ."', '". $password ."', 'member')";

	if ($con->query($sql) === TRUE) {
      
		echo json_encode(['status' => 'sucess', 'message' => '200']);
  } else {
	    echo "Error: " . $sql . "<br>" . $con->error;
  }


?>
