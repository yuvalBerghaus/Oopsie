<?php
    session_start();
    if (!isset($_SESSION["uid"])) {
        //  ^ redirect to login if the variable is NOT set
            header("Location: login/index.php");
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/scriptForm.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipurpose Bootstrap 5 Template</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
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
                        <a class="nav-link dropdown-toggle" href="#" aria-labelledby="navbarDropdownMenuLink" role="button"
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

    <div class="container pt-4" style="position:relative; margin-top:120px">

        <!--ADD BODY FORM HERE-->
        <div class="row">
            <h2 class="display-2 text-center text-muted my-4">
                Create Your Parking
            </h2>
            <br>
            <form action="PostParking.php" method="post" onsubmit="return addMySelf('<?php echo $_SESSION['username']?>')">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text">Parking Name</span>
                        <input type="text" id="pName" maxlength="10" name="parking_name" aria-label="First name" class="form-control">
                        <span class="input-group-text">Parking Address</span>
                        <input type="text" id="pAddress" maxlength="10" name="parking_address" aria-label="First name" class="form-control">
                        <div class="row">
            
            <div class="col-md-6">
                <h4 class="display-6 text-center text-muted my-4">Add Users to <div id="displayParkingNameInUsers"></div></h4>
                <div class="input-group">
                    <span class="input-group-text">User Name</span>
                    <input type="text" aria-label="First name" class="form-control" id="username" required>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-text">Category</span>
                    <select class="form-select" aria-label="Default select example" id="selectedCategory">
                        <option value="me">My Parking</option>
                        <option value="family">Family</option>
                        <option value="friends">Friend</option>
                    </select>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-text">Permission</span>
                    <select id="sel1" class="form-select" aria-label="Default select example">
                        <option value="main">Main</option>
                        <option value="secondary">Secondary</option>
                    </select>
                </div>
                <br>
                <button type="button" id="addUserButton" class="btn btn-secondary">Add User</button>
                <button type="button" id="clearUserInput" class="btn btn-secondary">Clear</button>
            </div>
            
            <div class="col-md-6">
                <h4 class="display-6 text-center text-muted my-4">Add Cars to <div id="displayParkingNameInCars"></div></h4>
                <div class="input-group">
                    <span class="input-group-text">Car Brand</span>
                    <input type="text" aria-label="car brand" class="form-control input-lg" id="carBrand" autocomplete="off">
                </div>
                <div id="match-list"></div>
                <br>
                <div class="input-group">
                    <span class="input-group-text">Plate Number</span>
                    <input type="text" aria-label="Plate number" class="form-control" id="plateNum">
                </div>
                <br>
                <button type="button" id="addCarButton" class="btn btn-secondary">Add Car</button>
                <button type="button" id="clearCarsInput" class="btn btn-secondary">Clear</button>
            </div>
        </div>
                    </div>
                    <br>
                    <input type="hidden" name="userData" id="userData" value="">
                    <input type="hidden" name="carData" id="carData" value="">
                </div>
                <div class="row">
            <div class="col-md-6">
            <h4>User List</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Permission</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="addedUsers">
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
            <h4>Car List</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Car Brand</th>
                            <th>Plate Number</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="addedCars">
                    </tbody>
                </table>
            </div>
        </div>
                <div class="container bg-light">
                     <div class="col-md-12 text-center">
                     <input type="submit" value="Submit Parking" class="btn btn-primary btn-lg center" id="submit">
                      </div>
                </div>
            </form>
        </div>
        <br>
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
                                <a class="dropdown-item" href="#">Youtube</a>
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