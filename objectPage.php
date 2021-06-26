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
$loggedUser = $_SESSION["uid"];
$u2p = $_GET['id'];
$sql = "SELECT * FROM tbl_userstoparkings_27 as utop JOIN tbl_users_27 as u on utop.user_id = u.user_id
JOIN tbl_parkinglots_27 as p on utop.parking_id = p.parking_id WHERE utop.users_to_parkings_id = $u2p";
$result = $conn->query($sql);
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
    <div class='container pt-4' style='position:relative; margin-top:120px'>
        <div class='row' style='justify-content:center'>
        <?php
        while($row = $result->fetch_assoc()) {
                     echo "
            <div class='row'>
                <h3 class='display-3 text-center text-muted my-4'>".$row['parking_name']."<!--Write title here-->
                </h3>
            </div>
            <dl class='row'>
            <table class='table table-dark'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>Username</th>
        <th scope='col'>Permission</th>
        <th scope='col'>Category</th>
      </tr>
    </thead>
    <tbody>";
    $parkingID = $row['parking_id'];
    $sqlTwo = "SELECT * FROM tbl_userstoparkings_27 as utop JOIN tbl_users_27 as u on utop.user_id = u.user_id
JOIN tbl_parkinglots_27 as p on utop.parking_id = p.parking_id WHERE utop.parking_id = $parkingID";
$resultTwo = $conn->query($sqlTwo);
$i = 1;
    while($rowTwo = $resultTwo->fetch_assoc()) {
        echo "
      <tr class='table-active'>
        <th scope='row'>$i</th>
        <td>".$rowTwo['username']."</td>
        <td>".$rowTwo['permission']."</td>
        <td>".$rowTwo['category']."</td>
      </tr>
      ";$i++;}
      echo "
    </tbody>
  </table>
        </div><!-- /footer -->
        ";}?>
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