<?php
include('db.php');
$users = $_POST['userData'];
$cars = $_POST['carData'];
$manageUsers = json_decode($users, true);
$manageCars = json_decode($cars, true);
$parkingName = $_POST['parking_name'];
$sql = "INSERT INTO tbl_parkinglots_27 (parking_name , owner_id) VALUES
('$parkingName', '$myUid')";
if(mysqli_query($conn, $sql))
    echo "Records added successfully.";
    
else {
    echo "IT DIDNT WORK";
    }
$last_idOfParking = $conn->insert_id;
echo $last_idOfParking;
// THIS LOOP IS FOR THE USERS
for ($i=0;$i<count($manageUsers);$i++){
    $permission = $manageUsers[$i]['permission'];
    $category = $manageUsers[$i]['category'];
    $sql = mysqli_query($conn,"SELECT `user_id` FROM `tbl_users_27` WHERE username = '".$manageUsers[$i]['user_name']."'");
    while ($row = mysqli_fetch_assoc($sql)) {
        $uid = $row["user_id"];
    }
    $sql = "INSERT INTO tbl_userstoparkings_27 (user_id, parking_id , permission , category) VALUES
    ('$uid' , '$last_idOfParking' , '$permission' , '$category')";
    if(mysqli_query($conn, $sql))
        echo "Records added successfully.";
    else {
        echo "Failed to add user";
    }
}
//THIS LOOP IS FOR THE CARS
if(count($manageCars)) {
    for ($i=0;$i<count($manageCars);$i++){
        $carBrand = $manageCars[$i]['carBrand'];
        $plateNum = $manageCars[$i]['plateNum'];
        $sql = "INSERT INTO tbl_cars_27 (car_brand , plate_number) VALUES
        ('$carBrand' , '$plateNum')";
        if(mysqli_query($conn, $sql))
            echo "Records added successfully.";
        $last_idOfCar = $conn->insert_id;
        echo $last_idOfParking;
        addCarsToParking($last_idOfCar, $last_idOfParking , $conn);
        
    }
}
header("Location: index.php");

function addCarsToParking($last_idOfCar, $last_idOfParking, $conn) {
    $sql = "INSERT INTO tbl_carstoparking_27 (parking_id , car_id) VALUES
    ('$last_idOfParking' , '$last_idOfCar')";
    if(mysqli_query($conn, $sql))
        echo "Records of carstoparking was added succesfully";
    else {
        echo "tried to add ".$last_idOfParking." and ".$last_idOfCar;
    }
}
mysqli_close($conn);
?>