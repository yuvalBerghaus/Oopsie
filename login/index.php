<?php
include('../db.php');
  // name of mail field
  if (!empty($_POST["email"])){
    //echo 'FORM SENT';
    $query  = "SELECT * FROM tbl_users_206 WHERE email='" 
    . $_POST["email"]. "' and password = '". $_POST["password"]."'";
    $result = mysqli_query($conn , $query);
    $row    = mysqli_fetch_array($result); 

    if(is_array($row)) {
      echo "success";
      session_start();
      $_SESSION["username"] = $row["username"];
      $_SESSION["uid"] = $row["user_id"];
      $user =$_SESSION['username'];
      $uid =$_SESSION['uid'];
      if (isset($_SESSION["uid"])) {
        //  ^ redirect to login if the variable is NOT set
            header("Location: ../index.php");
        }
    }
    else {
      $message = "Failed to connect";
      echo "<div class='error-message'>"; 
       if(isset($message)) {
         echo $message; 
        } 
      echo "</div>";
    }

  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Oops!e</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
    <!-- <div class="container">
      <h1 id="loginLogo"></h1>
      <form action="#" method="post" id="frm">
        <div class="form-group">
          <label for="loginMail">Email: </label>
          <input type="email" class="form-control" name="email" id="loginMail"
            aria-describedby="emailHelp" placeholder="Enter email" />
        </div>
        <div class="form-group">
          <label for="loginPass">Password: </label>
          <input type="password" class="form-control" name="password" id="loginPass"
            placeholder="Enter Password" />
        </div>
        <button type="submit" class="btn btn-primary">Log Me In</button>
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
    </div> -->
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
        <h1 id="loginLogo"></h1>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="#" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Username:</label><br>
                                <input type="text" name="email" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
