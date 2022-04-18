<?php include "database connection.php";
session_start();

$user_id = $_SESSION['user_id'];
$oldPass = $_POST['oldPassword'];
$newPass = $_POST['newPassword'];
$conPass = $_POST['conPassword'];

$getPass = "SELECT password FROM customer WHERE customer_id='$user_id'";
$resultPass = mysqli_query($con,$getPass);
$pass = mysqli_fetch_array($resultPass);
$dbOldPass = $pass['password'];

if($oldPass != $dbOldPass){
    $passWrong = urldecode("Password yang dimasukkan salah");
    header("Location:test_userprofile.php?err=".$passWrong);
}
else if($newPass != $conPass){
    $passNoMatch = urldecode("Password konfirmasi tidak cocok");
    header("Location:test_userprofile.php?err2=".$passNoMatch);
}
else if($oldPass == '' || $newPass == '' || $conPass == ''){
    $passEmpty = urldecode("Field tidak boleh kosong");
    header("Location:test_userprofile.php?err3=".$passEmpty);
}
else{
    $updatePass = "UPDATE customer SET password='$newPass' WHERE customer_id='$user_id'";
    $update = mysqli_query($con,$updatePass);
}
?>