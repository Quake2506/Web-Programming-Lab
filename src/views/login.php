<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.cdnfonts.com/css/aquire" rel="stylesheet">
    <style>
        .form-container {
            margin-top: 120px;
            max-width: 400px;
            background-color: rgb(247, 179, 96);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container form-container">
        <h2>Login Form</h2>
        <form action="login_processing.php" method="POST">
            <label class="pb-2" for="username">E-mail address:</label>
            <input class="form-control" type="email" id="username" name="username" required><br>

            <label class="pb-2" for="password">Password:</label>
            <input class="form-control" type="password" id="password" name="password" required><br>

            <button class="btn mr-2" style="background-color:#eeeeee;" type="submit">Login</button>

            <a href="?page=register" style="color:black">Don't have an account yet?</a>
        </form>
    </div>
</body>
</html>
