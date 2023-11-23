<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Department List</title>
  <style>
    h1 {
      left: 50%;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      /* Add this line to remove default margin */
      display: flex;
      /* Add this line to use flexbox */
      justify-content: center;
      /* Add this line to horizontally center the content */
      align-items: center;
      /* Add this line to vertically center the content */
    }

    .signout {
      display: flex;
      position: absolute;
      top: 92%;
      right: 0;
      border-radius: 20%;
      padding: 10px;
      background-color: #07125c;
      color: white;
      font-weight: bold;
    }

    .container {
      display: flex;
      width: 100%;
      height: 92.5vh;
    }

    .navbar {
      /* Remove 'position: fixed' */
      top: 0;
      left: 0;
      width: 150px;
      background-color: #07125c;
      padding: 20px;
      height: 94.3vh;
    }

    .navbar a {
      display: block;
      margin-bottom: 10px;
      color: #fff;
      text-decoration: none;
      padding: 15px;
      border-radius: 10px;
      /* box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); */
    }

    .navbar a:hover {
      background-color: #9d9ea1;
      color: #fff;
    }

    h2 {
      margin-left: 20%;
      position: absolute;
      top: 20px;
      left: 30%;
      text-align: center;
      color: #333;
      z-index: 1;

    }

    .table-container {
      flex: 1;
      padding: 20px;
      width: calc(50% - 80px);
      /* Adjust the width of the table container */
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);

    }

    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 100px;
    }

    table,
    th,
    td {
      border: 1px solid black;
      padding: 8px;
    }

    th {
      background-color: #07125c;
      color: white;
    }
  </style>
</head>

<body>
  <script>
    function submited(url) {
      window.location.href = url;
    }
  </script>
  <div class="container">
    <div class="navbar">
      <a href="home.html">Home</a>
      <a href="attendance.php">Attendance</a>
      <a href="employee.php">Employee List</a>
      <a href="position.php">Position List</a>
      <a href="department list.php">Department List</a>
      <a href="salary.php">Allowance</a>
    </div>
    <button class="signout" onclick="submited('index.html')">Signout</button>


    <?php
    // Database connection configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydb";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // // Execute the create table query
    if ($conn === TRUE) {
      $insertDataQuery = "INSERT INTO department (department_id, department_name) VALUES
      (1, 'HR'),
      (2, 'Marketing'),
      (3, 'Finance'),
      (4, 'IT')";

      //     // Execute the insert data query
      if ($conn->query($insertDataQuery) === TRUE) {

        //         // SQL query to retrieve data from the "department" table
        $retrieveDataQuery = "SELECT * FROM department";
        $result = $conn->query($retrieveDataQuery);

        if ($result->num_rows > 0) {
          // Generate the HTML table
          echo "<h2>Department Table</h2>";
          echo "<table>";
          echo "<tr><th>Department ID</th><th>Department Name</th></tr>";

          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["department_id"] . "</td>";
            echo "<td>" . $row["department_name"] . "</td>";
            echo "</tr>";
          }

          echo "</table>";
        } else {
          echo "No data found in the department table.";
        }
      } else {
        echo "Error inserting data: " . $conn->error;
      }
    } else {
      echo "Error creating table: " . $conn->error;
    }
    $retrieveDataQuery = "SELECT * FROM department";
    $result = $conn->query($retrieveDataQuery);

    if ($result->num_rows > 0) {
      // Generate the HTML table

    ?>
      <div class="table-container">
      <?php
      echo "<h2>Department Table</h2>";
      echo "<table>";
      echo "<tr><th>Department ID</th><th>Department Name</th></tr>";

      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["department_id"] . "</td>";
        echo "<td>" . $row["department_name"] . "</td>";
        echo "</tr>";
      }


      echo " <style>
    table {
        border-collapse: collapse;
        width: 100%;
      }
  
      table, th, td {
        border: 1px solid black;
        padding: 8px;
      }
  
      th {
        background-color: #07125c;
        color: white;
      }</style></table>";
    } else {
      echo "No data found in the department table.";
    }
      ?>
      </div>
      <?php
      // Close the database connection

      $conn->close();
      ?>
  </div>
</body>

</html>