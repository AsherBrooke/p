<?php
  header("Content-Type: application/json");
  include 'data.php';
  $get_token = empty(getallheaders()['Token']) ? '---' : getallheaders()['Token'];
  $sql = "SELECT * FROM admin WHERE token = '{$get_token}'";
  // echo $sql;
  // exit;
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    // while($row = $result->fetch_assoc()) {
    //   echo json_encode($row);
    // }
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Token ไม่ถูกต้อง']);
    exit;
  }
  $conn->close();
 ?>
