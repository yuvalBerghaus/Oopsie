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
//testing connection success
if(mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . 
 		mysqli_connect_errno() . ")");
}
session_start();
// if (!isset($_SESSION["uid"])) {
//     //  ^ redirect to login if the variable is NOT set
//         header("Location: ./index.php");
//     }

