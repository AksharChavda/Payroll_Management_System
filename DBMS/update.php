<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the ID and new department from the form data
  $id = $_POST["id"];
  $newDepartment = $_POST["department"];

  // Prepare and execute the SQL statement to update the data
  $stmt = $conn->prepare("UPDATE position SET department = ? WHERE id = ?");
  $stmt->bind_param("si", $newDepartment, $id);

  if ($stmt->execute()) {
    header("Location: position.php");
  } else {
    echo "Error updating data: " . $conn->error;
  }

  // Close the statement
  $stmt->close();
}

// Close the database connection
$conn->close();
?>
<label for="department">Department:</label>
<select id="department" name="department" required>
  <!-- Options here -->
</select><br><br>
