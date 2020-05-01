<?php
  //connect to SQLiteDatabase
  $conn = mysqli_connect('localhost', 'adminPC87', 'edit_mysql_admin_88', 'photo_candy');

  //check the connection
  if (!$conn) {
    echo "Connection error: " . mysqli_connect_error();
  }
  else {
    //write query for all entries
    $sql = 'SELECT * FROM users';

    //make query and get result
    $result = mysqli_query($conn, $sql);

    //fetch results rows as an array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print_r($users);

    //free the result
    mysqli_free_result($result);

    //close the connection
    mysqli_close($conn);
  }


?>
