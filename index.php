<?php
include('db.php');
session_start();
 if (!isset($_SESSION["uid"])) {
//     //  ^ redirect to login if the variable is NOT set
         header("Location: login/index.php");
    }
$loggedUserName = $_SESSION["username"];
$loggedUser = $_SESSION["uid"];
$sql = "SELECT * FROM tbl_userstoparkings_206 as utop JOIN tbl_users_206 as u on utop.user_id = u.user_id
JOIN tbl_parkinglots_206 as p on utop.parking_id = p.parking_id WHERE u.user_id = $loggedUser
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
            $secQuery = "SELECT * FROM tbl_users_206 as u WHERE u.user_id = $owner_id";
            $thirdQuery = "SELECT * FROM tbl_parkinglots_206 as p WHERE p.owner_id = $owner_id";
            $result2 = $conn->query($secQuery);
            $row2 = $result2->fetch_assoc();
            $result3 = $conn->query($thirdQuery);
            $row3 = $result3->fetch_assoc();
            echo "
          <div class='col-md-6 col-lg-4'>
              <div class='card mb-3 text-primary lead
              parkingObject' id='".$row['users_to_parkings_id']."'>
                  <div class='thumbnail' style=''>";
                    if($category != "me") {
                        echo "<img src='".$row2['imgRef']."' class='img-thumbnail defaultImg' title='".$row2['username']."' alt='picture'>";
                    }
                    else {
                        echo "<img src='".$row['imgRef']."' class='img-thumbnail defaultImg' alt='picture' title='".$row['username']."'>";
                    }
                    echo "
                  </div>
                  <div class='card-body'>
                  <h4 class='card-title display-5'>";
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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
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
            <span class="searchBar"><input type="text" name="search" placeholder="Search parking lot..."></span>
            <section id="welcome">
            <?php
            echo "Welcome ".$loggedUserName;
            ?>
            </section>
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
                            <li><a class="dropdown-item" href="#">Lotem ipsum</a></li>
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

    <div class="container pt-4" style="margin-top:120px">
        <div class="row" style="justify-content:center">
            <div class="row">
                <h3 class='display-3 text-center text-muted my-4'>My Parking Lists
                    <a href="form.php" class="link-secondary">
                       <img src="images/plus.png" style="height:50px;" alt="add new parking" title="add new parking">
                    </a>
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
            ?>
        </div>
        <!-- footer -->
        <div class="row py-3">
            <div class="col-md-7">
                <ul class="nav">
                    <li class="nav-item">
                    </li>
                </ul>
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
<?php 
$conn->close();
?>