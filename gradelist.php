<?php
$servername = "assign2-db.c3ywmegyszf9.us-east-2.rds.amazonaws.com";
$username = "dmathe17";
$password = "dmathe17";
$dbname = "assign2db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Collect and sanitize form data
$student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
$student_grade = mysqli_real_escape_string($conn, $_POST['student_grade']);

// Insert data into the database
$sql = "INSERT INTO grade-list (student_id, student_grade) VALUES ('$student_id', '$student_grade')";

if ($conn->query($sql) === TRUE) {
echo "Data inserted successfully!";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

// SHOW DATABASE
// Database connection
$conn = new mysqli("localhost", "username", "password", "database_name");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch grades by ID
$sql = "SELECT student_id, grade FROM grades_table ORDER BY student_id";
$result = $conn->query($sql);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades List</title>
</head>
<body>
    <h1>Grades by Student ID</h1>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<li>Student ID: " . $row["student_id"] . " - Grade: " . $row["grade"] . "</li>";
            }
        } else {
            echo "<li>No grades found.</li>";
        }
        ?>
    </ul>
</body>
</html>

<?php
$conn->close();
?>
