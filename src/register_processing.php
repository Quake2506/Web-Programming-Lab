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
    $userlevel = $_POST['options'];

    if ($userlevel === "user") {
        $sql = "INSERT INTO users (username, password, user_level) VALUES ('$username', '$password', '3')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php?page=login");
        }
    } elseif ($userlevel === "saler") {
        $sql = "INSERT INTO users (username, password, user_level) VALUES ('$username', '$password', '2')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php?page=login");
        }
    } else {
        $message = "Please choose a role.";
    }
}


?>
