<?php
  function authenticate($username, $password)
  {
    $hashed_password = hash("whirlpool", $password);
    $ret = false;

    $conn = mysqli_connect('localhost', 'adminPC87', 'edit_mysql_admin_88', 'photo_candy');
    if ($conn) {
      $sql = "SELECT password FROM users WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

      if (count($user) == 1)
      {
        print_r($user);
        if($user[0]['password'] == $hashed_password)
          $ret = true;
      }
      //free the result
      mysqli_free_result($result);
      //close the connection
      mysqli_close($conn);
    }
    echo "What";
    var_dump($ret);
    return $ret;
  }
?>
