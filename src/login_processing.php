<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    // Validate the received values (PHP)
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        echo "Password must be at least 8 characters long, including a number and an uppercase letter.";
        exit();
    }

    // Placeholder function for database retrieval
    function getUserFromDB($username) {
        $users = [
            'user@example.com' => ['password' => 'Password1', 'name' => 'John Doe'],
        ];
        return isset($users[$username]) ? $users[$username] : null;
    }

    // Assume a function `getUserFromDB` retrieves the user data from the database
    $user = getUserFromDB($username);

    if ($user && $user['password'] === $password) {
        // Login successful
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user['name'];
        setcookie("username", $username, time() + (86400 * 30), "/");
        header("Location: index.php");
    } else {
        // Login failed
        echo "<script>alert('Login failed: Invalid username or password'); window.location.href = 'login.php';</script>";
    }
}
