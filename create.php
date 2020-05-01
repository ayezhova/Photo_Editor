<?php
  //validate information, if invalid, write error messages
  $username = $password = $name = $email = "";
  $user_error = $pass_error = $name_error = $email_error = "";

  if (isset($_POST['submit']))
  {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $name = htmlspecialchars($_POST['nam']);
    $email = htmlspecialchars($_POST['mail']);

    if ($username == "")
      $user_error = "Username must not be empty.";
    else if (!preg_match('/^[a-zA-Z0-9._-]+$/', $username))
      $user_error = "Username may include letters, numbers or '._-' characters only.";
    else if (strlen($username) < 3 || strlen($username) > 15)
      $user_error = "Username must be between 3-15 characters.";

    //extension: Password advanced checks
    if ($password == "")
      $pass_error = "Password must not be empty.";
    else if (!preg_match('/^[a-zA-Z0-9._\-@#\$%=\+]+$/', $password))
      $pass_error = "Password may include letters, numbers or .@#$%-_=+ characters only.";
    else if (strlen($password) < 5 || strlen($password) > 50)
      $pass_error = "Password must be between 5-50 characters.";

    if ($name == "")
      $name_error = "Full Name must not be empty.";
    else if (!preg_match('/^[a-zA-Z ]+$/', $name))
      $name_error = "Name may include letters and spaces only.";
    else if (strlen($name) < 3 || strlen($name) > 100)
      $name_error = "Name must be between 3-100 characters.";

    if ($email == "")
      $email_error = "Email must not be empty.";
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      $email_error = "A valid email address is required.";
    else if (strlen($email) < 3 || strlen($email) > 100)
      $email_error = "Email must be between 3-100 characters.";

    if ($name_error == "" && $email_error == "" && $user_error == "" && $pass_error == "")
      header('Location: login.php');
  }
?>

  <?php include('srcs/header.php'); ?>

  <section id="create">
    <form id="create_form" action="" method="post" autocomplete="off">
      <h3>Sign Up</h3>
      <div>
        <input id="name_input" class="textbox" type="text" name="nam">
        <br />
        <div class="label">
          <label for="name">Full Name</label>
        </div> <!-- Label -->
        <p id="nameError" class="error">
          <?php
          if ($name_error == "")
            echo "&nbsp;";
          else
            echo $name_error;
          ?>
        </p>
      </div>
      <div>
        <input id="email_input" class="textbox" type="text" name="mail">
        <br />
        <div class="label">
          <label for="email_input_q">Email</label>
        </div> <!-- Label -->
        <p id="emailError" class="error">
          <?php
          if ($email_error == "")
            echo "&nbsp;";
          else
            echo $email_error;
          ?>
        </p>
      </div> <!-- Full Name -->
      <div>
        <input id="user_input" class="textbox" type="text" name="username">
        <br />
        <div class="label">
          <label for="username">Username</label>
        </div> <!-- Label -->
        <p id="userError" class="error">
          <?php
          if ($user_error == "")
            echo "&nbsp;";
          else
            echo $user_error;
          ?>
        </p>
      </div> <!-- Username -->
      <div>
        <input id="pass_input" class="textbox" type="password" name="password">
        <br />
        <div class="label">
          <label class="label" for="password">Password</label>
        </div> <!-- Label -->
        <p id="passError" class="error">
          <?php
          if ($pass_error == "")
            echo "&nbsp;";
          else
            echo $pass_error;
          ?>
        </p>
      </div> <!-- Password -->
      <div>
        <input id="submit" class="button" name="submit" type="submit" value="Sign Up" disabled>
      </div> <!-- Submit -->
      <script>
        function escapeHtml(text) {
          var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
          };
          return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        const name_inout = document.getElementById("name_input");
        const name_error = document.getElementById("nameError");
        const email_input = document.getElementById("email_input");
        const email_error = document.getElementById("emailError");
        const user_input = document.getElementById("user_input");
        const user_error = document.getElementById("userError");
        const pass_input = document.getElementById("pass_input");
        const pass_error = document.getElementById("passError");

        let name;
        let valid_name = 0;
        let email;
        let valid_email = 0;
        let username;
        let valid_user = 0;
        let password;
        let valid_pass = 0;

        name_input.addEventListener("focusout", function(event) {
          name = escapeHtml(name_input.value);
          if (name.length < 3 || name.length > 100)
          {
            name_error.innerHTML="Email must be between 3 and 100 characters.";
            valid_name = 0;
          }
          else if (!name.match(/^[a-zA-Z ]+$/))
          {
            name_error.innerHTML="Name may only contain letters and spaces.";
            valid_name = 0;
          }
          else {
            name_error.innerHTML="&nbsp;";
            valid_name = 1;
          }
          check_button();
        });

        email_input.addEventListener("focusout", function(event) {
          email = escapeHtml(email_input.value);
          if (email.length < 3 || email.length > 100)
          {
            email_error.innerHTML="Email must be between 3 and 100 characters.";
            valid_email = 0;
          }
          else if (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/))
          {
            email_error.innerHTML="Must be a valid email.";
            valid_email = 0;
          }
          else {
            email_error.innerHTML="&nbsp;";
            valid_email = 1;
          }
          check_button();
        });

        user_input.addEventListener("focusout", function(event) {
          username = escapeHtml(user_input.value);
          if (username.length < 3 || username.length > 15)
          {
            user_error.innerHTML="Username must be between 3 and 15 characters.";
            valid_user = 0;
          }
          else if (!username.match(/^[a-zA-Z0-9._-]+$/))
          {
            user_error.innerHTML="Username may include letters, numbers or '._-' characters only.";
            valid_user = 0;
          }
          else {
              user_error.innerHTML="&nbsp;";
              valid_user = 1;
          }
          check_button();
        });

        pass_input.addEventListener("focusout", function(event) {
          password = escapeHtml(pass_input.value);
          if (password.length < 5 || password.length > 50)
          {
            pass_error.innerHTML="Password must be between 5 and 50 characters.";
            valid_pass = 0;
          }
          else if (!password.match(/^[a-zA-Z0-9._\-@#\$%=\+]+$/))
          {
            pass_error.innerHTML="Password may include letters, numbers or .@#$%-_=+ only.";
            valid_pass = 0;
          }
          else {
              pass_error.innerHTML="&nbsp;";
              valid_pass = 1;
          }
          check_button();
        });

        const check_button = function()
        {
          if (valid_user && valid_pass && valid_email && valid_name)
            document.getElementById("submit").disabled = false;
          else
            document.getElementById("submit").disabled = true;
        }
      </script>
      <a href="login.php" style="padding-top: 10px;">Already have an account? Log in here!</a>
    </form>
  </section>
  <?php include('srcs/footer.php'); ?>
</html>
