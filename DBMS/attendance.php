<!DOCTYPE html>
<html>
<head>
  <title>Attendance</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    h1 {
      left: 50%;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0; /* Add this line to remove default margin */
      display: flex; /* Add this line to use flexbox */
      justify-content: center; /* Add this line to horizontally center the content */
      align-items: center; /* Add this line to vertically center the content */
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
    }

    .navbar a:hover {
      background-color: #9d9ea1;
      color: #fff;
    }

    .form-container {
      flex: 1;
      padding: 20px;
      width: calc(50% - 80px); /* Adjust the width of the form container */
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 5px #908e8e ;
    }

    .table-container {
      flex: 1;
      padding: 20px;
      width: calc(50% - 80px); /* Adjust the width of the table container */
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

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
    }

    .form-container h2,
    .table-container h2 {
      text-align: center;
    }

    .form-container form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .form-container label {
      width: 100%;
      margin-bottom: 5px;
    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .form-container input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    .form-container input[type="submit"] {
      background-color: #07125c;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
      background-color: #9d9ea1;
    }

    .delete-button {
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body>
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

    <!-- <h1>welcome back!!!</h1> -->
    <div class="form-container">
      <h2>Enter Details to add attendence</h2>
      <form id="myForm" method="POST" action="att.php">
        <label for="id">Employee ID:</label>
        <input type="text" id="id" name="id" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Submit">
      </form>
    </div>

    <div class="table-container">
      <h2>Attendence Table</h2>
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

        // Retrieve data from the database table
        $sql = "SELECT * FROM attendance";
        $result = $conn->query($sql);
      ?>

      <table id="dataTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Display data in table rows
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td class='delete-button'><a href='delete.php?id=" . $row["id"] . "'><i class='fas fa-trash'></i></a></td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='3'>No data found</td></tr>";
            }

            // Close the database connection
            $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
