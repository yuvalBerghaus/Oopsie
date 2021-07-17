<?php 
include('./db.php');
include('config.php');

if(isset($_POST['carID'])) {
  $id =  mysqli_real_escape_string($conn,$_POST['carID']);
  $sqlDelTwo = "DELETE FROM tbl_cars_27 WHERE car_id = (SELECT car_id FROM tbl_carstoparking_27 WHERE cTp_id = $id)";
  $sqlDelOne = "DELETE FROM tbl_carstoparking_27 WHERE cTp_id = $id";
  $conn->query($sqlDelTwo);
  $whoDelete = "cars";
  delete($id, $conn , $sqlDelOne, $whoDelete);
}
else if(isset($_GET['userstoparkingID'])) {
  $id =  mysqli_real_escape_string($conn,$_GET['userstoparkingID']);
  $sqlDelOne = "DELETE FROM tbl_parkinglots_27 WHERE parking_id = $id";
  $sqlDelTwo = "DELETE FROM tbl_userstoparkings_27 WHERE parking_id = $id";
  $sqlDelThree = "DELETE FROM tbl_carstoparking_27 WHERE parking_id = $id";
  $conn->query($sqlDelOne);
  $conn->query($sqlDelTwo);
  $conn->query($sqlDelThree);
  header("Location: index.php");
}
else if(isset($_POST['memberID'])) {
  $id =  mysqli_real_escape_string($conn,$_POST['memberID']);
  $sqlDelOne = "DELETE FROM tbl_userstoparkings_27 WHERE users_to_parkings_id = $id";
  $whoDelete = "users";
  delete($id, $conn , $sqlDelOne, $whoDelete);
}
function delete($id, $conn, $sqlDel, $whoDelete) {
        if ($conn->query($sqlDel) == TRUE) {
            $i = 1;
            if($whoDelete == "cars") {
              $sqlQueryCTP = "SELECT * FROM tbl_carstoparking_27 as ctop JOIN tbl_cars_27 as c on ctop.car_id = c.car_id
              JOIN tbl_parkinglots_27 as p on ctop.parking_id = p.parking_id WHERE ctop.parking_id = $id";
            $resultCTP = $conn->query($sqlQueryCTP);
            while($rowTwo = $resultCTP->fetch_assoc()) {
              echo "
                 <tr class='table-active'>
                    <th scope='row'>$i</th>
                    <td>".$rowTwo['car_brand']."</td>
                     <td>".$rowTwo['plate_number']."</td>
                     <td>
                     <button type='submit' value='".$rowTwo['cTp_id']."' name = 'valk'>
                     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                     <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                     <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                     </svg></button>
                     </td>
                     </tr>
            ";$i++;}
            }
            else if($whoDelete == "users") {
              $sqlTwo = "SELECT * FROM tbl_userstoparkings_27 as utop JOIN tbl_users_27 as u on utop.user_id = u.user_id
              JOIN tbl_parkinglots_27 as p on utop.parking_id = p.parking_id WHERE utop.parking_id = $id";
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
                      <button name='".$rowTwo['users_to_parkings_id']."' type='submit'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
              </svg></button>
              </button>
              </td>
              <td>
              <form id='updateUser' action='#' method='post'>
        <button value='".$rowTwo['users_to_parkings_id']."' type='submit'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
  <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
</svg></button></form>
</td>
              </td>
                    </tr>
                    ";$i++;}
            }
          }
           else {
            echo "Error deleting record: " . $conn->error;
          }
}
?>