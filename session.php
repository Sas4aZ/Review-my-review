<?php
require_once "config.php";
session_start();
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
$id = $_SESSION['id'] ;
//taking data for the other places.

$sql= "SELECT * FROM users WHERE id ='$id'";
$stmt = mysqli_query($conn, $sql);
$row= mysqli_fetch_array($stmt);
$email = $row['email'];
$_SESSION['password'] = $row['password'] ;
$_SESSION['email'] = $email ;
$username = $row['username'] ;
$firstname = $row['firstName'];
$lastname= $row['lastName'];
$image = $row['image'];
//$session_query = $conn->query("select * from users where id = '$session_id'");
//$result = $session_query->fetch();
//$username = $result['username'] ;
//$fullname = $result['firstName']." ".$result['lastName'];
//$image = $result['image'];

//$sql = "SELECT * FROM users where id = '$session_id'";
//$result=mysqli_prepare($conn,$sql);
//mysqli_stmt_fetch($result) ;
//$username = $result['username'] ;
//$fullname = $result['firstName']." ".$result['lastName'];
//$image = $result['image'];
//
?>