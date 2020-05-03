<?php
  include('srcs/header.php');
  include('srcs/authen.php');
  //validate information, if invalid, write error messages
  $username = $password = "";
  $user_error = $pass_error = $invalid_login = "";

  if (isset($_POST['submit']))
  {
    $username = htmlspecialchars($_POST['username']);

    if ($username == "")
      $user_error = "Username must not be empty.";
    else if (!preg_match('/^[a-zA-Z0-9._-]+$/', $username))
      $user_error = "Username may include letters, numbers or '._-' characters only.";
    else if (strlen($username) < 3 || strlen($username) > 15)
      $user_error = "Username must be between 3-15 characters.";
    $password = htmlspecialchars($_POST['password']);

    //extension: Password advanced checks
    if ($password == "")
      $pass_error = "Password must not be empty.";
    else if (!preg_match('/^[a-zA-Z0-9._\-@#\$%=\+]+$/', $password))
      $pass_error = "Password may include letters, numbers or .@#$%-_=+ characters only.";
    else if (strlen($password) < 5 || strlen($password) > 50)
      $pass_error = "Password must be between 5-50 characters.";

    if ($user_error == "" && $pass_error == "")
    {
      $name = authenticate($username, $password);
      if ($name != "") {
        $_SESSION['user'] = $name;
        header('Location: ./index.php');
      }
      else
        $invalid_login = "Sorry, the username or password do not match out records.";

    }
  }
?>

  <section id="create">
    <form id="create_form" action="" method="post" autocomplete="off">
      <h3>Log In</h3>
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
      <br />
      <p id="invalid_login" class="error">
        <?php
        if ($invalid_login == "")
          echo "&nbsp;";
        else
          echo $invalid_login;
        ?>
      </p>
      <div>
        <input id="submit" class="button" name="submit" type="submit" value="Sign Up" style="margin-top:80px" disabled>
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

        const user_input = document.getElementById("user_input");
        const user_error = document.getElementById("userError");
        const pass_input = document.getElementById("pass_input");
        const pass_error = document.getElementById("passError");

        let username;
        let valid_user = 0;
        let password;
        let valid_pass = 0;

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
          if (valid_user == 1 && valid_pass == 1)
            document.getElementById("submit").disabled = false;
          else
            document.getElementById("submit").disabled = true;
        }
      </script>
      <a href="create.php" style="padding-top: 10px;">Need an account? Sign up here!</a>
    </form>
  </section>
  <?php include('srcs/footer.php'); ?>
</html>
