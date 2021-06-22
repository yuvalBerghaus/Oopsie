<?php
$servername = "182.50.133.173";
$username = "studDB21a";
$password = "stud21DB1!";
$dbname = "studDB21a";
session_start();
$myUid = $_SESSION['uid'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$users = $_POST['userData'];
$cars = $_POST['carData'];
$manageUsers = json_decode($users, true);
$parkingName = $_POST['parking_name'];
$sql = "INSERT INTO tbl_parkinglots_27 (parking_name , owner_id) VALUES
('$parkingName', '$myUid')";
echo $sql;
if(mysqli_query($conn, $sql))
    echo "Records added successfully.";
    
else {
    echo "IT DIDNT WORK";
    }
$last_id = $conn->insert_id;
echo $last_id;
for ($i=0;$i<count($manageUsers);$i++){
    $permission = $manageUsers[$i]['permission'];
    $category = $manageUsers[$i]['category'];
    $sql = mysqli_query($conn,"SELECT `user_id` FROM `tbl_users_27` WHERE username = '".$manageUsers[$i]['user_name']."'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $uid = $row["user_id"];
        // echo $row["user_id"];
    }
    $sql = "INSERT INTO tbl_userstoparkings_27 (user_id, parking_id , permission , category) VALUES
    ('$uid' , '$last_id' , '$permission' , '$category')";
    if(mysqli_query($conn, $sql))
        echo "Records added successfully.";
}
mysqli_close($conn);
?>