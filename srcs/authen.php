<?php
  function authenticate($username, $password)
  {
    $hashed_password = hash("whirlpool", $password);
    $ret = "";

    $conn = mysqli_connect('localhost', 'adminPC87', 'edit_mysql_admin_88', 'photo_candy');
    if ($conn) {
      $sql = "SELECT password, name FROM users WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

      if (count($user) == 1)
      {
        if($user[0]['password'] == $hashed_password)
          $ret = $user[0]['name'];
      }
      //free the result
      mysqli_free_result($result);
      //close the connection
      mysqli_close($conn);
    }
    return $ret;
  }
?>
