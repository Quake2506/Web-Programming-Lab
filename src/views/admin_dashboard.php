<?php
if (!isset($_SESSION['username']) || $_SESSION['user_level'] != '1') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style> 
        .button {
            background-color: #211f1d;
            border: none;
            margin: 0;
            padding: 12px;
            width: fit-content;
            transition: 0.3s;
            color: rgb(251, 160, 49);
            font-weight: bolder;
            font-size: 16px;
            text-align: center;
        }
        .button:hover {
            background-color: rgb(251, 160, 49);
            margin: 0;
            padding: 12px;
            width: fit-content;
            color: #211f1d;
            font-weight: bolder;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center align-items-center flex-column">
    <h1>Welcome, Admin <?php echo $_SESSION['name']; ?>!</h1>
        <div>
        <a class="button" href="?page=manage_users">Manage Users</a>
        <a class="button" href="?page=manage_products">Manage Products</a>
        </div>
    </div>
    
    
</body>
</html>
