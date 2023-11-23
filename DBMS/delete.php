<?php
include 'attendance.php';
$host="localhost";
$user="root";
$password="";
$db="mydb";

$conn = mysqli_connect($host,$user,$password,$db);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "DELETE FROM attendance WHERE id = $id";
if(mysqli_query($conn, $sql)){
    // header("Location: attendance.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>