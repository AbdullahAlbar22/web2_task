<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myproject";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle toggle action
if (isset($_GET['toggle_id'])) {
    $id = (int)$_GET['toggle_id'];

    // Get current status
    $result = mysqli_query($conn, "SELECT status FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $currentStatus = $row['status'];

    // Toggle status
    $newStatus = $currentStatus == 0 ? 1 : 0;

    mysqli_query($conn, "UPDATE users SET status = $newStatus WHERE id = $id");
    header("Location: users.php"); // Refresh page
    exit;
}

// Get all users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f2f2f2;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #4facfe;
            color: white;
        }
        button {
            padding: 8px 12px;
            background: #4facfe;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #00c6ff;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Users List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= $row['Age']; ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <a href="users.php?toggle_id=<?= $row['id']; ?>">
                    <button>Toggle</button>
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
mysqli_close($conn);
?>
