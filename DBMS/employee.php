<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        h1 {
            left: 50%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0; /* Add this line to remove default margin */
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
            height: 92.5vh;
        }

        .navbar {
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

        .content {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 20px;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 5px #908e8e;
            padding: 20px;
            margin-bottom: 20px;
        }

        .table-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
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
        .searbtn{
            background-color: #07125c;
            color: white;
            border-radius: 10px;
            /* padding: 10px; */
            margin-left: 10px;
        }

        
    </style>
</head>
<body>
    <!-- <h1>Employee List</h1> -->
    <div class="container">
        <div class="navbar">
            <a href="home.html">Home</a><br>
            <a href="attendance.php">Attendance</a><br>
            <a href="employee.php">Employee List</a><br>
            <a href="position.php">Position List</a><br>
            <a href="department list.php">Department List</a><br>
            <a href="salary.php">Allowance</a><br>
        </div>
        <button class="signout" onclick="submited('index.html')">Signout</button>

        <div class="content">
            <div class="form-container">
                <form method="POST" action="">
                    <label for="search">Search:</label>
                    <input type="text" name="search" id="search" placeholder="Enter ID or Name">
                    <!-- <button type="submit" name="submit">Search</button> -->
                    <button type="submit" name="submit" class="searbtn">&#128269; Search</button>
                </form>
            </div>

            <div class="table-container">
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
                } else {
                    $sql = "SELECT id, name, email, position, salary FROM employees";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Generate the HTML table
                    echo '<table>';
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
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo "No data found in the employees table.";
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>
</html>
