<?php
include('../db.php');
  // name of mail field
  if (!empty($_POST["email"])){
    //echo 'FORM SENT';
    $query  = "SELECT * FROM tbl_users_27 WHERE email='" 
    . $_POST["email"]. "' and password = '". $_POST["password"]."'";
    echo $query;
    $result = mysqli_query($conn , $query);
    $row    = mysqli_fetch_array($result); 

    if(is_array($row)) {
      echo "success";
      session_start();
      $_SESSION["username"] = $row["username"];
      $_SESSION["uid"] = $row["user_id"];
      $user =$_SESSION['username'];
      $uid =$_SESSION['uid'];
      // $sesssion_id=$_SESSION['user_id'];
      if (isset($_SESSION["uid"])) {
        //  ^ redirect to login if the variable is NOT set
            header("Location: ../index.php");
        }
    } else {
      echo "failure";
    }

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>JOINS</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="container">
      <h1>Login</h1>
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
        <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div> 
      </form>
    </div>
  </body>
</html>
