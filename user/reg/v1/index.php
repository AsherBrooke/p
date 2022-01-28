<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
date_default_timezone_set('Asia/Bangkok');
include 'token.php';
include 'data.php';
$status = $_SERVER["REQUEST_METHOD"];
// print_r($_SERVER);
// exit;
// $status = 'POST';
if ($status) {
  // print_r($_POST);
  // print_r($_GET);
  // exit;
  if (empty($_POST['username'])) {
    echo json_encode(['status' => 'false', 'message' => 'username require']);
    exit;
  }
  if (empty($_POST['password'])) {
    echo json_encode(['status' => 'false', 'message' => 'password require']);
    exit;
  }
  if ($_POST["password"] != $_POST["repassword"]) {
    echo json_encode(['status' => 'false', 'message' => 'password ไม่ตรงกัน']);
    exit;
  }
  // use sql
  // Check connection
  if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => $conn->connect_error]);
    exit;
  }
  // sql get
  $sql_get = "SELECT * FROM users WHERE username = '{$_POST['username']}'";
  $result_get = $conn->query($sql_get);
  if ($result_get->num_rows > 0) {
    while($row_get = $result_get->fetch_assoc()) {
      echo json_encode(['status' => 'false', 'message' => ' มีผู้ใช้งานเเล้ว']);
      exit;
    }
  }
  // sql add
  $username = $_POST["username"];
  $password = $_POST["password"];
  $repassword = $_POST["repassword"];
  $date = date('Y-m-d H:i:s');
  $sql = "INSERT INTO users (id, username, password)
	 				VALUES('', '". $username ."', '". $password ."')";
  if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
    $new_user = array(
      'username' => $username,
      'password' => $password,
    );
    echo json_encode([
      'status' => 'true',
      'message' => 'success',
      'data' => $new_user,
    ]);
  } else {
    // echo "Error: " . $sql . "<br>" . $conn->error;
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
    exit;
  }
}else {
  echo json_encode(['status' => 'error', 'message' => 'ส่งค่ามาผิด']);
  exit;
}
 ?>
