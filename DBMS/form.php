<?php

$email = $_POST['email'];
$password = $_POST['password'];

$host = "localhost";
$user = "root";
$password = "";
$db = "mydb";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM loginpage WHERE email='$email'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Employee ID already exists')</script>";
    echo "<script>window.location.href='index.html'</script>";
    exit();
}

$sql = "INSERT INTO loginpage (email,password ) VALUES ('$email','$password')";

if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header('Location:home.html');
