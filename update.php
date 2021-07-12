<?php
include('db.php');
include('config.php');
if(isset($_POST['u2pID'])) {
    $id = $_POST['u2pID'];
    $permission = $_POST['selectedPermission'];
    $category = $_POST['selectedCategory'];
    $sqlUpdate = "UPDATE tbl_userstoparkings_27
    SET permission = '$permission', category= '$category'
    WHERE users_to_parkings_id = $id";
    $conn->query($sqlUpdate);
  }
?>