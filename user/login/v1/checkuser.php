<?php include 'data.php';?>
<?php
  header("Content-Type: application/json");
  $name_post = $_POST['username'];
  $password_post = $_POST['password'];
  $sql = "SELECT * FROM users";
  $sql = "SELECT * FROM users WHERE username = '{$name_post}'";
  $result = $con->query($sql);
  // print_r( $result);
  // exit;
  if ($result->num_rows > 0) {
  //   // output data of each row
    while($row = $result->fetch_assoc()) {
      // echo "username: " . $row["username"]. " - password: " . $row["password"]. " " . "<br>";

      // if ($row["username"] != $username) {
      //   echo '<script>';
      //   echo 'alert("Password Wrong")';
      //   echo '</script>';
      //   echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=http://localhost/login">';
      //   // echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=http://localhost/login.html">';
      //   // header('Location: http://localhost/backend/login.php');
      //   exit;
      // }
      if ($row["password"] != $password_post) {
        // echo '<script>';
        // echo 'alert("Password Wrong")';
        // echo '</script>';
        // echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL='. $lurl .'">';
        echo json_encode(['status' => 'error', 'message' => 'passwordไม่ถูกต้อง']);
        // echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=http://localhost/login.html">';
        // header('Location: http://localhost/backend/login.php');
        exit;
      }

      $uid = $row["id"];
      $username = $row["username"];
      $password = $row["password"];
      $group = $row["group"];

      session_start();
      $_SESSION["username"] =  $username;
      // $_SESSION["name"] =  $username;
      $_SESSION["id"] = $uid;
      $_SESSION["group"] = $group;
      // header('Location: http://localhost/content/index.php');
      // header('Location: '. $linkurl .'');
      echo json_encode(['status' => 'success', 'message' => '200']);

    }
  } else {
    // echo '<script>';
    // echo 'alert("ไม่พบผู้ใช้งาน")';
    // echo '</script>';
    // echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL='. $lurl .'">';
    // echo '<META HTTP-EQUIV="Refresh" CONTENT="0;URL=http://localhost/login.html">';
    // header('Location: http://localhost/backend/login.php');
    echo json_encode(['status' => 'error', 'message' => 'ไม่พบผู้ใช้งาน']);
    exit;
  }
  $con->close();
?>
