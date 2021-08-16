<?php
include('db.php');
include('config.php');
if(isset($_POST['u2pID'])) {
    $id =  mysqli_real_escape_string($conn,$_POST['u2pID']);
    $permission =  mysqli_real_escape_string($conn,$_POST['selectedPermission']);
    $category =  mysqli_real_escape_string($conn,$_POST['selectedCategory']);
    $sqlUpdate = "UPDATE tbl_userstoparkings_206
    SET permission = '$permission', category= '$category'
    WHERE users_to_parkings_id = $id";
    $conn->query($sqlUpdate);


    $parkingID = $_SESSION['parking_id'];
    $sqlTwo = "SELECT * FROM tbl_userstoparkings_206 as utop JOIN tbl_users_206 as u on utop.user_id = u.user_id
JOIN tbl_parkinglots_206 as p on utop.parking_id = p.parking_id WHERE utop.parking_id = $parkingID";
$resultTwo = $conn->query($sqlTwo);
$i = 1;
    while($rowTwo = $resultTwo->fetch_assoc()) {
        if($rowTwo['user_id'] != $_SESSION['uid']) {
        echo "
      <tr class='table-active'>
        <th scope='row'>$i</th>
        <td>".$rowTwo['username']."</td>
        <td>
        <select name='selectedPermission' id='".$rowTwo['users_to_parkings_id']."Permission'>
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
<select name='selectedCategory' id='".$rowTwo['users_to_parkings_id']."Category'>
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
        if($_SESSION['myPermission'] == 'main') {
            echo "
        <button form='deleteUser' value='".$rowTwo['users_to_parkings_id']."' type='submit'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg>
</button>
</td>
<td>
        <button form='updateUser' value='".$rowTwo['users_to_parkings_id']."' type='submit'>
        <img src='images/success.png' style='height:20px' alt='update'>
        </button>
</td>
      </tr>
      ";}}$i++;}
}