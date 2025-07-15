<?php
// Database connection info
$servername = "localhost";
$username = "root"; // XAMPP default user
$password = "";
$dbname = "myproject"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int)$_POST['age'];

    $sql = "INSERT INTO users (name, age) VALUES ('$name', $age)";

    if (mysqli_query($conn, $sql)) {
        echo "<h2>Data inserted successfully!</h2>";
        echo "<a href='index.html'>Go back</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "No direct access allowed!";
}
?>


