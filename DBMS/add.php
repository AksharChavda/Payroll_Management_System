<?php
// Retrieve form data
$id = $_POST['id'];
$name = $_POST['name'];
$department = $_POST['department'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL query to insert the form data into the table
$sql = "INSERT INTO position (id, Name, department) VALUES ('$id', '$name', '$department')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    header("Location: position.php");
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();
