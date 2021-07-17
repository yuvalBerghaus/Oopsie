<?php
include('db.php');
include('config.php');
$loggedUser = $_SESSION["uid"];
$loggedUserName = $_SESSION["username"];
$u2p = mysqli_real_escape_string($conn, $_GET['id']);
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
    <script type="text/javascript" src="js/scriptForm.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/crud.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#cccccc">
        <div class="container" style="">  <!-- ADDED JUSTIFY CONTENT -->
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
            echo "Welcome back ".$loggedUserName;
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
                            <li><a class="dropdown-item" href="#">lorem ipsum</a></li>
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
    <div class='container' style='margin-top:120px'>
        
        <?php
        $row = $result->fetch_assoc();
                     echo "  
        <div class='row' style='justify-content:center'>
            <h3 class='display-3 text-center text-muted my-4'>".$row['parking_name']."<!--Write title here-->
                     </h3>      
                <img src='https://media-cdn.tripadvisor.com/media/photo-s/06/6d/0f/c0/red-roof-inn-durham-duke.jpg' alt='car' class='img-thumbnail' style='width:30%'>
        </div>
        <div class='row table-responsive-sm'>
            <h3 class='display-6 text-center text-muted my-4'>Members<!--Write title here-->
            </h3>
            <table class='table table-dark table-sm'>
             <thead>
             <tr>
                  <th scope='col'>#</th>
                    <th scope='col'>Username</th>
                      <th scope='col'>Permission</th>
                       <th scope='col'>Category</th>
                          <th scope='col'>";
        if($row['permission'] == 'main') {
        echo "<img style='height:25px; filter: brightness(0) invert(1);' alt='add user' src='images/addUser.png'>";
        }
        echo "
        </th>
        <th></th>
        </tr>
    </thead>
    <tbody id='userTableList'>";
    $parkingID = $row['parking_id'];
    $sqlTwo = "SELECT * FROM tbl_userstoparkings_27 as utop JOIN tbl_users_27 as u on utop.user_id = u.user_id
JOIN tbl_parkinglots_27 as p on utop.parking_id = p.parking_id WHERE utop.parking_id = $parkingID";
$resultTwo = $conn->query($sqlTwo);
$i = 0;
    while($rowTwo = $resultTwo->fetch_assoc()) {
        if($rowTwo['user_id'] != $row['user_id']) {
        echo "
      <tr class='table-active'>
        <th scope='row'>$i</th>
        <td>".$rowTwo['username']."</td>
        <td>
        <select name='selectedPermission' id='selectedPermission'>
  <option value='".$rowTwo['permission']."' selected>".$rowTwo['permission']."</option>
  ";
  if($rowTwo['permission'] == 'main') {
      echo " <option value='secondary'>secondary";
  }
  else {
      echo " <option value='main'>main";
  }
  echo "
  </option>
</select></td>
<td>
<select name='selectedCategory' id='selectedCategory'>
";
$categoryArray = array("me", "family", "friends");
for($j = 0 ; $j < 3 ; $j++) {
    if($categoryArray[$j] == $rowTwo['category']) {
        echo "<option value='".$rowTwo['category']."' selected>".$rowTwo['category']."</option>";
    }
    else {
        echo "<option value='".$categoryArray[$j]."'>".$categoryArray[$j]."</option>";
    }
}
echo "
</select></td>
        <td>
        ";
        if($row['permission'] == 'main') {
            echo "
            <form id='deleteUsers' action='#' method='post'>
        <button value='".$rowTwo['users_to_parkings_id']."' type='submit'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg></button></form>
</td>
<td>
<form id='updateUser' action='#' method='post'>
        <button value='".$rowTwo['users_to_parkings_id']."' type='submit'>
        <img src='images/success.png' style='height:20px' alt='update'>
        </button></form>
</td>
      </tr>
      ";}}$i++;}?>
    </tbody>
  </table>
  </div>
  <div class='row'>
  <h3 class='display-6 text-center text-muted my-4'>Cars<!--Write title here-->
  </h3>
  <form id='deleteCars' action='#' method='post'>
  <table class='table table-dark table-sm'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>Car brand</th>
        <th scope='col'>Plate Number</th>
        <th scope='col'>
            <?php
            if($row['permission'] == 'main') {
                echo "<img src='images/cars.png' style='height:25px' alt='cars'>";
            }
            ?>
        </th>
      </tr>
    </thead>
    <tbody id="carsTableList"><?php
    $sqlQueryCTP = "SELECT * FROM tbl_carstoparking_27 as ctop JOIN tbl_cars_27 as c on ctop.car_id = c.car_id
    JOIN tbl_parkinglots_27 as p on ctop.parking_id = p.parking_id WHERE ctop.parking_id = $parkingID";
$resultCTP = $conn->query($sqlQueryCTP);
$i = 0;
    while($rowTwo = $resultCTP->fetch_assoc()) {
        echo "
      <tr class='table-active'>
        <th scope='row'>".($i+1)."</th>
        <td>".$rowTwo['car_brand']."</td>
        <td>".$rowTwo['plate_number']."</td>
        <td>";
        if($row['permission'] == 'main') {
        echo "
        <button type='submit' value='".$rowTwo['cTp_id']."'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg></button>
</td>
      </tr>
      ";}$i++;} $i = 0;?>
    </tbody>
  </table>
  </form>
  </div>
  <?php
  if($row['permission'] != 'main') {
    echo "";
  }
  else {
      echo "
      <div class='row'>
      <div class='col-md-6'>
          <h4 class='display-6 text-center text-muted my-4'>Add Users to ".$row['parking_name']."</h4>
          <div class='input-group'>
              <span class='input-group-text'>User Name</span>
              <input type='text' aria-label='First name' class='form-control' placeholder='Add a new member to your parking...' id='username' required>
          </div>
          <br>
          <div class='input-group'>
              <span class='input-group-text'>Category</span>
              <select class='form-select' aria-label='Default select example' id='selectedCategory'>
                  <option value='me'>My Parking</option>
                  <option value='family'>Family</option>
                  <option value='friends'>Friend</option>
              </select>
          </div>
          <br>
          <div class='input-group'>
              <span class='input-group-text'>Permission</span>
              <select id='sel1' class='form-select' aria-label='Default select example'>
                  <option value='main'>Main</option>
                  <option value='secondary'>Secondary</option>
              </select>
          </div>
          <br>
          <button type='button' id='addUserButton' class='btn btn-secondary'>Add User</button>
          <button type='button' id='clearUserInput' class='btn btn-secondary'>Clear</button>
      </div>
      
      <div class='col-md-6'>
          <h4 class='display-6 text-center text-muted my-4'>Add Cars to ".$row['parking_name']."</h4>
          <div class='input-group'>
              <span class='input-group-text'>Car Brand</span>
              <input type='text' aria-label='car brand' placeholder='Type the desired car brand...' class='form-control input-lg' id='carBrand' autocomplete='off'>
          </div>
          <div id='match-list'></div>
          <br>
          <div class='input-group'>
              <span class='input-group-text'>Plate Number</span>
              <input type='text'  placeholder='Type the cars plate number...' oninput='this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');' maxlength='7' aria-label='Plate number' class='form-control' id='plateNum' >
          </div>
          <br>
          <button type='button' id='addCarButton' class='btn btn-secondary'>Add Car</button>
          <button type='button' id='clearCarsInput' class='btn btn-secondary'>Clear</button>
      </div>
  </div>
              <input type='hidden' name='userData' id='userData' value=''>
              <input type='hidden' name='carData' id='carData' value=''>
      <br>
  <div class='row'>
      <div class='col-md-6'>
      <h4>User List</h4>
          <table class='table table-striped'>
              <thead>
                  <tr>
                      <th>Username</th>
                      <th>Permission</th>
                      <th>Category</th>
                  </tr>
              </thead>
              <tbody id='addedUsers'>
              </tbody>
          </table>
      </div>
      <div class='col-md-6'>
      <h4>Car List</h4>
          <table class='table table-striped'>
              <thead>
                  <tr>
                      <th>Car Brand</th>
                      <th>Plate Number</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody id='addedCars'>
              </tbody>
          </table>
      </div>
      <div class='row bg-light'>
               <div class='col-md-12 text-center'>
              <form action='#' id='updateExistingParking' method='post' onsubmit='saveFile()'>
              <input type='hidden' name='userData' id='userData' value=''>
      <input type='hidden' name='carData' id='carData' value=''>
               <button type='submit' value='".$row['parking_id']."' class='btn btn-primary btn-lg center' id='submit'>Add to my parking</button>
      </form>
                </div>
          <div class='col-md-12 text-center'>
       <form method='get' action='delete.php'><button value='".$row['parking_id']."' style='' name='userstoparkingID' class='btn btn-danger' type='submit'>
      Delete Parking
         </button></form>";}?>
         </div>
  <!-- /footer -->
  </div> 
  </div><!--endofrow -->

        <!-- /Container-->
    <!-- JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
        crossorigin="anonymous"></script>
</body>

</html>