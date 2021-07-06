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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/object.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#cccccc">
        <div class="container" style="justify-content:unset">
            <!-- ADDED JUSTIFY CONTENT -->
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
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-search"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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
        <div class='row'>
            <?php
        $row = $result->fetch_assoc();
                     echo "
            <div class='row'>
                <h3 class='display-3 text-center text-muted my-4'>".$row['parking_name']."<!--Write title here-->
                </h3>
                <img src='https://media-cdn.tripadvisor.com/media/photo-s/06/6d/0f/c0/red-roof-inn-durham-duke.jpg' style='height:70%; width:auto'>
            </div>
            <div class='row'>
            <div class='col'>
            <h3 class='display-6 text-center text-muted my-4'>Members<!--Write title here-->
            </h3>
            <table class='table table-dark'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>Username</th>
        <th scope='col'>Permission</th>
        <th scope='col'>Category</th>
        <th scope='col'></th>
      </tr>
    </thead>
    <tbody><form id='deleteUsers' action='#' method='post'>";
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
        <td>
        <button value='".$rowTwo['users_to_parkings_id']."' type='submit'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg></button>
</td>
      </tr>
      ";$i++;}?>
            </tbody>
            </table>
            </form>
        </div>
        <div class='col'>
            <h3 class='display-6 text-center text-muted my-4'>Cars
                <!--Write title here-->
            </h3>
            <form id='deleteCars' action='#' method='post'>
                <table class='table table-dark'>
                    <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Car brand</th>
                            <th scope='col'>Plate Number</th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    $sqlQueryCTP = "SELECT * FROM tbl_carstoparking_27 as ctop JOIN tbl_cars_27 as c on ctop.car_id = c.car_id
    JOIN tbl_parkinglots_27 as p on ctop.parking_id = p.parking_id WHERE ctop.parking_id = $parkingID";
$resultCTP = $conn->query($sqlQueryCTP);
$i = 1;
    while($rowTwo = $resultCTP->fetch_assoc()) {
        echo "
      <tr class='table-active'>
        <th scope='row'>$i</th>
        <td>".$rowTwo['car_brand']."</td>
        <td>".$rowTwo['plate_number']."</td>
        <td>
        <button type='submit' value='".$rowTwo['cTp_id']."'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg></button>
</td>
      </tr>
      ";$i++;}?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    </div>
    <!--endofrow -->



    <!-- /footer -->
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