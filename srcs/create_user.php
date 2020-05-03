<?php

  function create_user ($name, $email, $username, $password){
    $conn = mysqli_connect('localhost', 'adminPC87', 'edit_mysql_admin_88', 'photo_candy');

    if ($conn) {
      //hash the password
      $password = hash("whirlpool", $password);

      //protect database
      $name = mysqli_real_escape_string($conn, $name);
      $email = mysqli_real_escape_string($conn, $email);
      $username = mysqli_real_escape_string($conn, $username);
      $password = mysqli_real_escape_string($conn, $password);

      //create sql
      $sql = "INSERT INTO users(name, email, username, password) VALUES('$name', '$email', '$username', '$password')";

      //save to db
      mysqli_query($conn, $sql);

      mysqli_close($conn);
    }
  }
?>
