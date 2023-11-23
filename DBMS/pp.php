<!DOCTYPE html>
<html>
<head>
    <title>Employee Information</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Employee Information</h1>
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

    // Create the table
    $sql = "CREATE TABLE IF NOT EXISTS employees (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        position VARCHAR(50) NOT NULL,
        salary DECIMAL(10, 2) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {

        // Check if the table has any rows
        $sql = "SELECT COUNT(*) as count FROM employees";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $rowCount = $row['count'];

        // Insert sample data into the table if it has no rows
        if ($rowCount === '0') {
            $sampleData = [
                ['John Doe', 'john@example.com', 'Manager', 5000.00],
                ['Jane Smith', 'jane@example.com', 'Developer', 4000.00],
                ['Michael Johnson', 'michael@example.com', 'Sales Representative', 3000.00],
                ['Emily Davis', 'emily@example.com', 'Assistant Manager', 4500.00],
                ['David Anderson', 'david@example.com', 'Designer', 3500.00],
                ['Sarah Wilson', 'sarah@example.com', 'Accountant', 3800.00],
                ['Brian Lee', 'brian@example.com', 'IT Specialist', 4200.00],
                ['Jessica Taylor', 'jessica@example.com', 'HR Manager', 4800.00],
                ['Richard Brown', 'richard@example.com', 'Marketing Analyst', 3700.00],
                ['Laura Miller', 'laura@example.com', 'Operations Supervisor', 4100.00]
            ];

            foreach ($sampleData as $data) {
                $name = $data[0];
                $email = $data[1];
                $position = $data[2];
                $salary = $data[3];

                $sql = "INSERT INTO employees (name, email, position, salary)
                        VALUES ('$name', '$email', '$position', $salary)";

                if ($conn->query($sql) === TRUE) {
                } else {
                    echo "Error inserting data: " . $conn->error;
                }
            }
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // Retrieve data from the employees table
    $sql = "SELECT id, name, email, position, salary FROM employees";
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
</body>
</html>
