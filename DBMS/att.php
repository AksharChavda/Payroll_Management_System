<?php
// Retrieve form data
$id = $_POST['id'];
$email = $_POST['email'];

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
$sql = "INSERT INTO attendance (id, email) VALUES ('$id', '$email')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    header("Location: attendance.php");
} else {
    echo "Error inserting data: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
