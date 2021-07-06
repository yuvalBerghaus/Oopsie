<?php
$servername = "182.50.133.173";
$username = "studDB21a";
$password = "stud21DB1!";
$dbname = "studDB21a";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();
if (!isset($_SESSION["uid"])) {
    //  ^ redirect to login if the variable is NOT set
        header("Location: login/index.php");
    }
$loggedUser = $_SESSION["uid"];
$sql = "SELECT * FROM tbl_userstoparkings_27 as utop JOIN tbl_users_27 as u on utop.user_id = u.user_id
JOIN tbl_parkinglots_27 as p on utop.parking_id = p.parking_id WHERE u.user_id = $loggedUser
";
$result = $conn->query($sql);
$result2 = $conn->query($sql);
$result3 = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}


function getParkingList(mysqli_result $result , mysqli $conn , string $category) {
    while($row = $result->fetch_assoc()) {
        if($row['category'] == $category) {
            $owner_id = $row['owner_id'];
            $secQuery = "SELECT * FROM tbl_users_27 as u WHERE u.user_id = $owner_id";
            $thirdQuery = "SELECT * FROM tbl_parkinglots_27 as p WHERE p.owner_id = $owner_id";
            $result2 = $conn->query($secQuery);
            $row2 = $result2->fetch_assoc();
            $result3 = $conn->query($thirdQuery);
            $row3 = $result3->fetch_assoc();
            echo "
          <div class='col-md-6 col-lg-4'>
              <div class='card mb-3 parkingObject' id='".$row['users_to_parkings_id']."' style='align-items: center;'>
                  <div class='thumbnail' style='margin-left:120px'>
                      <img src='".$row2['imgRef']."' class='rounded-circle' alt='Fjords' style='width:20%;'>
                  </div>
                  <div class='card-body'>
                  <h4 class='card-title'>";
                  if($category == "me") {
                    //   echo $row3['parking_name'];
                    echo $row['parking_name'];
                  }
                  else {
                    // echo $row2['first_name']."'s parking";
                    echo $row2['first_name']."'s parking";
                  }
                  echo "</h4>
                  <p class='card-text'>Permission : ".$row['permission']."<br>Parking name:".$row['parking_name']."</p>
                  ";
                  if($row['permission'] == 'main') {
echo "
<div class='dropdown'>
<button style='width:100%' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><img style='height:25px;width:25px' src='images/actions.png'>Actions
<span class='caret'></span></button>
<ul class='dropdown-menu p-3 mb-2'>
  <li>Tow it</li>
  <li>Throw objects</li>
  <li>Identify</li>
  <li>Pancture</li>
</ul>
</div>
<br>
";
                  }
                  echo"
                <div class='dropdown'>
                <button style='width:100%' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'><img style='height:25px;width:25px' src='images/analysis.png'>Analysis
                <span class='caret'></span></button>
                <ul class='dropdown-menu'>
                  <li>Tow it</li>
                  <li>Throw objects</li>
                  <li>Identify</li>
                  <li>Pancture</li>
                </ul>
              </div>
              <br>
              <button style='width:100%' class='btn btn-primary' type='button' data-toggle='dropdown'><img style='height:25px;width:25px' src='images/members.png'>Members
                </button>
              <br>
              <br>
              <button style='width:100%' class='btn btn-primary' type='button' data-toggle='dropdown'><img style='height:25px;width:25px' src='images/cars.png'>Cars
              </button>
              <br>
              <br>
              ";
              if($row['permission'] == 'main') {
              echo "
              <button style='width:100%' class='btn btn-primary' type='button' data-toggle='dropdown'><img style='height:25px;width:25px' src='images/events.png'>Events
              </button>
              <br>
              <br>
              <form method='get' action='delete.php'><button value='".$row['parking_id']."' style='width:100%' name='userstoparkingID' class='btn btn-danger' type='submit'>Delete
              </button></form>
              ";}
              echo "
                   </div>
              </div>
          </div>
            ";
        }
    }
  }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops!e</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/scriptIndex.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#cccccc">
        <div class="container" style="justify-content:unset">  <!-- ADDED JUSTIFY CONTENT -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <section id="myLogo">
                </section>
            </a>
            <span class="searchBar"><input type="text" name="search" placeholder="Search.."></span>
            <section class="iconsNav">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </section>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto text-primary">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkOne" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Notifications
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkOne">
                            <li><a class="dropdown-item" href="#">Full Stack JavaScript</a></li>
                            <li><a class="dropdown-item" href="#">Python</a></li>
                            <li><a class="dropdown-item" href="#">Artificial Intelligence</a></li>
                            <li><a class="dropdown-item" href="#">Mobile Development</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkSecond" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkSecond">
                            <li><a class="dropdown-item" href="#">My Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container pt-4" style="position:relative; margin-top:120px">
        <div class="row" style="justify-content:center">
        <!-- <section style="margin:0">
                Welcome back <?php echo $_SESSION['username'] ?>
            </section> -->
            <div class="row">
                <h3 class='display-3 text-center text-muted my-4'>My Parking Lists
                <a href="form.php" class="link-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg></a>
                </h3>
            </div>
        <div class="row">                                <!-- CHANGED MAX WIDTH TO NONE -->
        
        <h3 class='display-4 text-center text-muted my-4'>My Parking Lots</h3>
            <?php
            getParkingList($result3, $conn , "me");
            ?>
        </div>
        <hr>
        <div class="row">
            <h3 class='display-4 text-center text-muted my-4'>Family Parking Lots</h3>
                <?php
                getParkingList($result, $conn , "family");
                ?>
        </div>
        <hr><!-- /signup form -->
        <div class="row">
            <h2 class='display-4 text-center text-muted my-4'>Friends Parking Lots</h2>
            <?php 
            getParkingList($result2, $conn , "friends");
            $conn->close();
            ?>
        </div>
        <!-- footer -->
        <div class="row py-3">
            <div class="col-md-7">
                <ul class="nav">
                    <li class="nav-item">
                        <!-- Example single danger button -->
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Social Media
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="#">Youtube</a>
                                <a class="dropdown-item" href="https://www.facebook.com/mark.berghaus.3/">Facebook</a>
                                <a class="dropdown-item" href="#">Instagram</a>
                                <a class="dropdown-item" href="#">Twitter</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md text-md-right">
                <small>&copy; 2021 <a href="#">Bootstrap</a></small>
            </div>
            </div>
        </div><!-- /footer -->
    </div> <!-- /Container-->
    <!-- JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>
</body>

</html>