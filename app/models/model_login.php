<?php
class Model_Login extends Model {
  public function get_data() {
    $loginUser = array(
      "login_status" => 1
    );
    return $loginUser;
  }
  public function check_data($login, $password) {
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($con->connect_errno) {
    printf("Connect failed: %s\n", $con->connect_error);
      exit();
    }
    $data = array();
    $login = mysqli_real_escape_string($con, $login);
    $password = mysqli_real_escape_string($con, $password);
    $password = md5($password);
   // var_dump($password);
    $query    = "SELECT * FROM `users` WHERE email='$login' and password='$password'";
       // var_dump($query);

    if($result = $con->query($query) ) {
         // var_dump($result);
        $r=$result->fetch_assoc();
         // var_dump($r);
        foreach($r as $k=>$v) {
          // var_dump($k);
          if($k !== 'password') {
            $data[$k] = $v;
            // var_dump($data[$k]);
          }
        }
      if($data["active"] == 0) {
        $con->close();
        return FALSE;
      }
        setcookie("user_name", $data['full_name']);
        setcookie("user_id", $data["id"]);
    } else {

      $con->close();
      return FALSE;
    }
    $con->close();
    // var_dump($data);
    return $data;
  }
}
