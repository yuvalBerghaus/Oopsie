<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yuval";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM userstoparkings as utop JOIN users as u on utop.user_id = u.user_id
JOIN parkinglots as p on utop.parking_id = p.parking_id WHERE u.user_id = 1 
";
$result = $conn->query($sql);
$result2 = $conn->query($sql);
$result3 = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}


function printRow(mysqli_result $result , mysqli $conn , string $category) {
    while($row = $result->fetch_assoc()) {
        if($row['category'] == $category) {
            $owner_id = $row['owner_id'];
            $secQuery = "SELECT * FROM users as u WHERE u.user_id = $owner_id";
            $result2 = $conn->query($secQuery);
            $row2 = $result2->fetch_assoc();
            echo "
          <div class='col-md-6 col-lg-4'>
              <div class='card mb-3' style='align-items: center;'>
                  <div class='thumbnail'>
                      <img src='".$row2['imgRef']."' class='rounded-circle' alt='Fjords' style='width:30%'>
                  </div>
                  <div class='card-body'>
                  <h4 class='card-title'>".$row2['first_name']."s parking</h4>
                  <p class='card-text'>Permission : ".$row['permission']."<br>".$row['category']."</p>
                  <div class='dropdown'>
                  <button style='width:100%' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Actions
                  <span class='caret'></span></button>
                  <ul class='dropdown-menu'>
                    <li><a href='#'>Tow it</a></li>
                    <li><a href='#'>Throw objects</a></li>
                    <li><a href='#'>Identify</a></li>
                    <li><a href='#'>Pancture</a></li>
                  </ul>
                </div>
                <br>
                <div class='dropdown'>
                <button style='width:100%' class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Analysis
                <span class='caret'></span></button>
                <ul class='dropdown-menu'>
                  <li><a href='#'>Tow it</a></li>
                  <li><a href='#'>Throw objects</a></li>
                  <li><a href='#'>Identify</a></li>
                  <li><a href='#'>Pancture</a></li>
                </ul>
              </div>
              <br>
              <button style='width:100%' class='btn btn-primary' type='button' data-toggle='dropdown'>Members
                <span class='caret'></span></button>
              <br>
              <br>
              <button style='width:100%' class='btn btn-primary' type='button' data-toggle='dropdown'>Events
              <span class='caret'></span></button>
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
    <title>Responsive Multipurpose Bootstrap 5 Template</title>
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#cccccc">
        <div class="container" style="justify-content:unset">  <!-- ADDED JUSTIFY CONTENT -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <section id="myLogo">
                </section>
            </a>
            <span class="searchBar"><input type="text" name="search" placeholder="Search.."></span>
            <section class="iconsNav">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
</section>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto text-primary">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Notifications
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Full Stack JavaScript</a></li>
                            <li><a class="dropdown-item" href="#">Python</a></li>
                            <li><a class="dropdown-item" href="#">Artificial Intelligence</a></li>
                            <li><a class="dropdown-item" href="#">Mobile Development</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Real Life Projects</a></li>
                            <li><a class="dropdown-item" href="#">Online Marketing</a></li>
                            <li><a class="dropdown-item" href="#">Business & Ideas</a></li>
                            <li><a class="dropdown-item" href="#">Stock Trading</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="" class="d-block w-100" alt="...">
            </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- /carousel -->

    <div class="container pt-4" style="margin-top:90px">
        <div class="row" style="justify-content:center">
            <div class="row">
                <h3 class='display-3 text-center text-muted my-4'>My Parking Lists</h3>
                <i class="glyphicon glyphicon-plus"></i>
            </div>
        <div class="row">                                <!-- CHANGED MAX WIDTH TO NONE -->
        
        <h3 class='display-4 text-center text-muted my-4'>My Parking Lots</h3>
            <?php
            printRow($result3, $conn , "my");
            ?>
        </div>
        <hr>
        <div class="row">
            <h3 class='display-4 text-center text-muted my-4'>Family Parking Lots</h3>
                <?php
                printRow($result, $conn , "family");
                ?>
        </div>
        <hr><!-- /signup form -->
        <div class="row">
            <h2 class='display-4 text-center text-muted my-4'>Friends Parking Lots</h3>
            <?php 
            printRow($result2, $conn , "friends");
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