<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.cdnfonts.com/css/aquire" rel="stylesheet">
    <style>
        .form-container {
            margin-top: 120px;
            max-width: 400px;
            background-color: rgb(247, 179, 96);
            padding: 20px;
            border-radius: 10px;
            text-align:left;
        }
    </style>
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var reenter_password = document.getElementById('reenter_password').value;
            var radios = document.getElementsByName('options');
            var formValid = false;
            var errorMessage = '';

            // Check if passwords match
            if (password !== reenter_password) {
                errorMessage += 'Passwords do not match.<br>';
                formValid = false;
            } else {
                formValid = true;
            }

            // Check if any radio button is selected
            var isChecked = false;
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    isChecked = true;
                    break;
                }
            }
            if (!isChecked) {
                errorMessage += 'Please select a role.<br>';
                formValid = false;
            } else {
                formValid = formValid && true;
            }

            // Display error message if validation fails
            if (!formValid) {
                var errorDiv = document.getElementById('error-message');
                errorDiv.innerHTML = errorMessage;
                errorDiv.classList.remove('d-none');
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="container form-container">
        <h2>Register Form</h2>
        <form id="myForm" onsubmit="return validateForm()" action="register_processing.php" method="POST">
            <label class="mb-2" for="username">E-mail address:</label>
            <input class="form-control" type="email" id="username" name="username" required><br>

            <label class="mb-2" for="password">Password:</label>
            <input class="form-control" type="password" id="password" name="password" required><br>

            <label for="reenter_password">Re-enter Password:</label>
            <input class="form-control" type="password" id="reenter_password" name="reenter_password" required><br>

            <div class="d-flex flex-row">
                <div class="form-check mb-2" style="margin-right:20px"> 
                    <input class="form-check-input" type="radio" name="options" value="user" id="user"> 
                    <label class="form-check-label" for="user"> User </label> 
                </div>

                <div class="form-check mb-2"> 
                    <input class="form-check-input" type="radio" name="options" value="saler" id="saler"> 
                    <label class="form-check-label" for="saler"> Saler </label> 
                </div>
            </div>
            
            <button class="btn mt-1" style="background-color:#eeeeee;" type="submit">Register</button>

            <a href="?page=login" style="color:black">Already have an account ?</a>
        </form>
        <div id="error-message" class="alert alert-danger mt-3 d-none"></div>
    </div>
</body>
</html>










