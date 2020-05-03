<?php session_start(); ?>
<!-- Header information, stylesheet include -->

<html>
  <head>
    <meta charset="UTF-8">
    <meta name="description" content="Photo Editor online, superpose images on webcame photo">
    <link rel="stylesheet" type="text/css" href="srcs/style.css" />
    <title>Photo Candy</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
  </head>
  <body>
  <header>
    <div id="header_bar">
      <a href="./index.php" class="div1">
        <img src="asset/v2.png" alt="" class="logo">
        <span id="header_text">Photo Candy</span>
      </a>
      <div class="div2">
        <?php
        if (!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user'] == ""))
        {
          echo '<a href="login.php" class="button">Log In</a>';
        }
        else
        {

          echo '<a href="srcs/logout.php">' . $_SESSION['user'] . '</a>';
        }
        ?>
      </div>
    </div> <!-- Header_bar -->
  </header>
