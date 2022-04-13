<?php include "database connection.php";
$keyword = $_GET['keyword'];
$sql = "SELECT * FROM merchant WHERE merchantName LIKE '%$keyword%'";
$result = mysqli_query($con,$sql);
$output = [];

while($row=mysqli_fetch_array($result)){
    array_push($output,$row);
}

echo json_encode($output);
