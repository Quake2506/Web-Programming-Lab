<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check username
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if ($user['password'] === $password) {
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_level'] = $user['user_level'];

            // Redirect based on user level
            if ($_SESSION['user_level'] == '1') {
                header("Location: index.php");
            } elseif ($_SESSION['user_level'] == '2') {
                header("Location: index.php");
            } else {
                header("Location: index.php");
            }
            exit(); // Ensure script stops here
        } else {
            echo "<script>alert('Invalid password'); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid username'); window.location.href = 'login.php';</script>";
    }
}

$conn->close();
?>
