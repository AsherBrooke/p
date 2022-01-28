 <?php
 include 'token.php';
 include 'data.php';
 $check = '0';
 header("Content-Type: application/json");
 $status = $_SERVER["REQUEST_METHOD"];
   $sql = "SELECT * FROM users";
   $result = $conn->query($sql);

   if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
       if ($row['username'] != $_POST['username']) {
         echo json_encode(['status' => 'false', 'message' => 'username ไม่ถูกต้อง']);
         exit;
       }
       if ($row['password'] != $_POST['password']) {
         echo json_encode(['status' => 'false', 'message' => 'password ไม่ถูกต้อง']);
         exit;
       }
        $check = '1';
        if ($check == '1') {
          $sql2 = "SELECT * FROM users WHERE username = '{$_POST['username']}' ";
          $result2 = $conn->query($sql2);

          if ($result2->num_rows > 0) {
            // output data of each row
            while($rowu = $result2->fetch_assoc()) {
              $new_user = array(
                   'id' => $rowu['id'],
                   'username' => $_POST['username'],
                   'group' => $rowu['group'],
                 );
                 echo json_encode([
                   'status' => 'true',
                   'message' => 'success',
                   'data' => $new_user,
                 ]);
            }
          } else {
            echo json_encode(['status' => 'error', 'message' => '0 row result']);
            exit;
          }
          $conn->close();
         }else {
           // code...
         }
     }
   } else {
     echo json_encode(['status' => 'error', 'message' => '0 row result']);
     exit;
   }
?>
