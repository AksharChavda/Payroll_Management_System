<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$rollnumber = mysqli_real_escape_string($conn, $_POST['rollnumber']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

$sql = "INSERT INTO students (name, rollnumber, email, mobile) VALUES ('$name', '$rollnumber', '$email', '$mobile')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header('location:prac1.php');
?>
```