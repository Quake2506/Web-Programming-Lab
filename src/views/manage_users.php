<?php

if (!isset($_SESSION['username']) || $_SESSION['user_level'] != '1') {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_prog_lab";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // Variable to store operation messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_level = $_POST['user_level'];
    
    if ($action == 'insert') {
        $sql = "INSERT INTO users (username, password, user_level) VALUES ('$username', '$password', '$user_level')";
        if ($conn->query($sql) === TRUE) {
            $message = "New user added successfully.";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'update') {
        $id = $_POST['id'];
        $sql = "UPDATE users SET username='$username', password='$password', user_level='$user_level' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $message = "User updated successfully.";
        } else {
            $message = "Error updating record: " . $conn->error;
        }
    } elseif ($action == 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $message = "User deleted successfully.";
        } else {
            $message = "Error deleting record: " . $conn->error;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin-top: 60px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h1, h2 {
            color: #333;
        }
        form {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select, button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: rgb(251, 160, 49);
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #211f1d;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
            color: white;
            background-color: green;
        }
    </style>
</head>
<body>
    <h1>Manage Users</h1>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <h2>Add User</h2>
    <form  method="POST">
        <input type="hidden" name="action" value="insert">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="user_level">User Level:</label>
        <select id="user_level" name="user_level">
            <option value="1">Admin</option>
            <option value="2">Saler</option>
            <option value="3">User</option>
        </select><br>
        
        <button type="submit">Add User</button>
    </form>

    <h2>Update User</h2>
    <form  method="POST">
        <input type="hidden" name="action" value="update">
        <label for="id">User ID:</label>
        <input type="text" id="id" name="id" required><br>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        
        <label for="user_level">User Level:</label>
        <select id="user_level" name="user_level">
            <option value="1">Admin</option>
            <option value="2">Saler</option>
            <option value="3">User</option>
        </select><br>
        
        <button type="submit">Update User</button>
    </form>

    <h2>Delete User</h2>
    <form  method="POST">
        <input type="hidden" name="action" value="delete">
        <label for="id">User ID:</label>
        <input type="text" id="id" name="id" required><br>
        
        <button type="submit">Delete User</button>
    </form>
</body>
</html>
