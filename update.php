<?php
include('db.php');
include('config.php');
if(isset($_POST['u2pID'])) {
    $id =  mysqli_real_escape_string($conn,$_POST['u2pID']);
    $permission =  mysqli_real_escape_string($conn,$_POST['selectedPermission']);
    $category =  mysqli_real_escape_string($conn,$_POST['selectedCategory']);
    $sqlUpdate = "UPDATE tbl_userstoparkings_27
    SET permission = '$permission', category= '$category'
    WHERE users_to_parkings_id = $id";
    $conn->query($sqlUpdate);
    
  }
?>