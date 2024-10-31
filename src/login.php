<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.cdnfonts.com/css/aquire" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: rgb(255,255,255);
            margin: 0;
            margin-top: 60px;
            padding: 0;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        footer {
            margin: 0;
            padding: 15px;
            position: fixed;
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
            padding: 12px;
            color: rgb(251, 160, 49);
            font-weight: bolder;
            font-size: 16px;
            font-family: 'Aquire', sans-serif;
        }
        .navButton:hover {
            background-color: rgb(251, 160, 49);
            color: rgb(0, 0, 0);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='orange' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .form-container {
            margin-top: 120px;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
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
                        <a class="btn navButton d-none d-md-block" href="?page=about">ABOUT US</a>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item"><a class="btn navButton d-none d-md-block" href="logout.php">LOGOUT</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="btn navButton d-none d-md-block" href="login.php">LOGIN</a></li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="btn navButton d-none d-md-block" href="?page=dashboard">USER</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container form-container">
        <h2>Login Form</h2>
        <form action="login_processing.php" method="POST">
            <label for="username">E-mail address:</label>
            <input type="email" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>
    </div>

    <footer>
        <p>Powered by Damwon Kia</p>
    </footer>
</body>
</html>
