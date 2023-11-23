<!DOCTYPE html>
<html>

<head>
  <title>Allowance List</title>
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
      height: 95.4vh;
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
      width: calc(50% - 80px);
      /* Adjust the width of the form container */
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 5px #908e8e;

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



    .form-container h1,
    .table-container h2 {
      text-align: center;
      margin-top: 90px;
      padding: 0;

    }

    .form-container form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 25px;

    }

    .form-container label {
      width: 100%;
      margin-bottom: 5px;
      font-size: 25px;

    }

    .form-container input[type="text"],
    .form-container input[type="email"],
    .seabtn {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    .seabtn {
      background-color: #07125c;
      color: #fff;
      font-weight: bold;
      cursor: pointer;
    }

    .seabtn:hover {
      background-color: #9d9ea1;
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
      <a href="#">Allowance</a>

    </div>
    <button class="signout" onclick="submited('index.html')">Signout</button>
    <div class="form-container">
      <h1>Employee Information</h1>
      <form method="POST" action="">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" placeholder="Enter ID or Name">
        <button type="submit" name="submit" class="seabtn">Search</button>
      </form>
    </div>
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

    // Retrieve data from the employees table
    if (isset($_POST['submit'])) {
      $searchTerm = $_POST['search'];

      // Query to search based on ID or Name using subqueries
      $sql = "SELECT id, name, email, position, salary FROM employees WHERE id IN (SELECT id FROM employees WHERE id = '$searchTerm') OR name LIKE '%$searchTerm%'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Generate the HTML table
        echo '<table class="table-container">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Position</th>';
        echo '<th>Salary</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Output data for each row
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row["id"] . '</td>';
          echo '<td>' . $row["name"] . '</td>';
          echo '<td>' . $row["email"] . '</td>';
          echo '<td>' . $row["position"] . '</td>';
          echo '<td>' . $row["salary"] . '</td>';
          echo '</tr>';

          // Calculate salary based on number of months worked
          $id = $row["id"];
          $name = $row["name"];
          $email = $row["email"];
          $position = $row["position"];
          $salary = $row["salary"];

          // Assume number of months worked as 12 (you can modify this based on your requirement)
          $numMonthsWorked = 12;
          $numMonthsWork = 6;
          $calculatedSalary = $salary * $numMonthsWorked;

          $calculatedSalar = $salary * $numMonthsWork;

          echo '<tr>';
          echo '<td colspan="5">Calculated Salary for 12 months' . $name . ': ' . $calculatedSalary . '</td>';


          echo '</tr>';
          echo '<tr>';
          echo '<td colspan="5">Calculated Salary for 6 months' . $name . ': ' . $calculatedSalar . '</td>';

          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>
            <style>
            table {
                // border-collapse: collapse;
                width: 100%;
              }
          
              table, th, td {
                
                padding: 8px;
              }
          
              th {
                border: 1px solid black; 
                background-color: #07125c;
                color: white;
              } 
              td{
                border: 1px solid black;
              }
              </style>';
      } else {
        echo "No data found in the employees table.";
      }
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>
</body>

</html>