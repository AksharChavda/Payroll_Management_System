<!DOCTYPE html>
<html>
<head>
  <title>Position List</title>
  <style>
    h1 {
      left: 50%;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
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
      height: 94.3vh;
      width: 100%;
    }

    .navbar {
      width: 150px;
      background-color: #07125c;
      padding: 20px;
      height: 100%;
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
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 5px #908e8e;
    }

    .table-container {
      flex: 1;
      padding: 20px;
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
    .form-container select#department {
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
    .update-button {
      background-color: #07125c;
      color: #fff;
      font-weight: bold;
      border: none;
      padding: 8px 12px;
      border-radius: 4px;
      cursor: pointer;
      float: right;
    }

    .update-button:hover {
      background-color: #9d9ea1;
    }

    .update-button span {
      margin-right: 5px;
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
    <div class="form-container">
      <h2>Enter Details</h2>
      <form id="myForm" method="POST" action="ps.php">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="department">Department:</label>
        <select id="department" name="department" required>
          <option value="">Select department</option>
          <option value="HR">HR</option>
          <option value="Marketing">Marketing</option>
          <option value="Finance">Finance</option>
          <option value="IT">IT</option>
        </select><br><br>

        <input type="submit" value="Submit">
      </form>
    </div>

    <div class="table-container">
      <h2>Table</h2>
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
        $sql = "SELECT * FROM position";
        $result = $conn->query($sql);
      ?>

      <table id="dataTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Display data in table rows
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["Name"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>
                        <form action='update.php' method='POST'>
                          <input type='hidden' name='id' value='" . $row["id"] . "'>
                          <select name='department' required>
                            <option value='HR'>HR</option>
                            <option value='Marketing'>Marketing</option>
                            <option value='Finance'>Finance</option>
                            <option value='IT'>IT</option>
                         </select>
                          <button type='submit' class='update-button'>
                            <span>&#x270E;</span>
                          </button>
                        </form>
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>No data found</td></tr>";
            }

            // Close the database connection
            $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <button class="signout" onclick="submited('index.html')">Signout</button>
</body>
</html>