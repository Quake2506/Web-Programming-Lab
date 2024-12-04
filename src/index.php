<?php session_start(); 

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.cdnfonts.com/css/aquire" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f5f5;
            margin-top: 60px;
            height: 100%;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        footer {
            margin-top: 50px;
            padding: 15px;
            bottom: 0;
            width: 100%;
            background-color: #211f1d;
            color: rgb(251, 160, 49);
            font-weight: bolder;
            font-size: 16px;
            font-family: 'Aquire', sans-serif;
            text-align: center;
            
        }
        .navButton {
            background-color: #211f1d;
            border: none;
            margin: 0;
            padding: 12px;
            width: fit-content;
            transition: 0.3s;
            color: rgb(251, 160, 49);
            font-weight: bolder;
            font-size: 16px;
            font-family: 'Aquire', sans-serif;
            text-align: center;
        }
        .navButton:hover {
            background-color: rgb(251, 160, 49);
            margin: 0;
            padding: 12px;
            width: fit-content;
            color: #211f1d;
            font-weight: bolder;
            font-family: 'Aquire', sans-serif;
            text-align: center;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='orange' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .content { 
            flex: 1; 
        }
        .dropdown-menu {
            background-color: #211f1d;
            border: none;
            margin: 0;
            padding: 12px;
            width: fit-content;
            transition: 0.3s;
            color: rgb(251, 160, 49);
            font-weight: bolder;
            font-size: 16px;
            font-family: 'Aquire', sans-serif;
            text-align: center;
            transition: all 0.3s ease;
            display: none;
            position: absolute;
            will-change: transform;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
            top: 100%;
            left: 0;
            margin: 0;
        }
        .productCard {
            width: 20rem;
            border:none; 
            text-decoration: none;
            color: black;
            padding: 20px;
            transition: 0.5s;
            background-color: #f5f5f5;
        }
        .productCard:hover {
            width: 20rem;
            border:none; 
            text-decoration: none;
            color: black;
            background-color: #d4d4d4;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md fixed-top" style="background-color: #211f1d;">
        <div class="container-xxl">
            <a href="#intro" class="navbar-brand">
                <span class="fw-bold" style="color: rgb(251, 160, 49); font-family: 'Aquire', sans-serif; font-size: 24px;">
                    DK Enterprise
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
                    aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn navButton d-none d-md-block" href="?page=home">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link navButton dropdown-toggle btn" href="?page=products" id="navbarDropdown" role="button" aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item navButton" href="?page=basins">BASINS</a></li>
                            <li><a class="dropdown-item navButton" href="?page=tubs">TUBS</a></li>
                            <li><a class="dropdown-item navButton" href="?page=accessories">ACCESSORIES</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="btn navButton d-none d-md-block" href="?page=find">FIND OUR STORE</a>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item"><a class="btn navButton d-none d-md-block" href="logout.php">LOGOUT</a></li>
                        <li class="nav-item">
                            <a class="btn navButton d-none d-md-block" href="?page=dashboard">USER</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="btn navButton d-none d-md-block" href="?page=login">LOGIN</a></li>
                        <li class="nav-item">
                            <a class="btn navButton d-none d-md-block" href="?page=register">REGISTER</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content" id="content">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'home':
                    include './views/home.php';
                    break;
                case 'products':
                    include './views/products.php';
                    break;
                case 'basins':
                    include './views/basins.php';
                    break;
                case 'tubs':
                    include './views/tubs.php';
                    break;
                case 'accessories':
                    include './views/accessories.php';
                    break;
                case 'search':
                    include './views/search.php';
                    break;
                case 'product_info':
                    include './views/product_info.php';
                    break;
                case 'find':
                    include './views/find.php';
                    break;
                case 'login':
                    include './views/login.php';
                    break;
                case 'register':
                    include './views/register.php';
                    break;
                case 'manage_users':
                    include './views/manage_users.php';
                    break;
                case 'manage_products':
                    include './views/manage_products.php';
                    break;
                case 'dashboard':
                    switch($_SESSION['user_level']){
                        case 1:
                            include './views/admin_dashboard.php';
                            break;
                        case 2:
                            include './views/saler_dashboard.php';
                            break;
                        default:
                            include './views/user_dashboard.php';
                            break;
                    }
                    break;
                default:
                    echo '<p>Page not found</p>';
            }
        } else {
            include './views/home.php';
        }
        ?>
    </div>
</body>
<footer>
    <section id="footer">
        <p>Powered by Damwon Kia</p>
    </section>
</footer>
</html>
