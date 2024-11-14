<?php
if (!isset($_SESSION['username']) || ($_SESSION['user_level'] != '1' && $_SESSION['user_level'] != '2')) {
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
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $price = $_POST['price'];
    $image_link = $_POST['image_link'];

    if ($action == 'insert') {
        $sql = "INSERT INTO products (product_name, product_description, price, image_link) VALUES ('$product_name', '$product_description', '$price','$image_link')";
        if ($conn->query($sql) === TRUE) {
            $message = "New product added successfully.";
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'update') {
        $id = $_POST['id'];
        $sql = "UPDATE products SET product_name='$product_name', product_description='$product_description', price='$price', image_link='$image_link' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Product updated successfully.";
        } else {
            $message = "Error updating record: " . $conn->error;
        }
    } elseif ($action == 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM products WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $message = "Product deleted successfully.";
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
    <title>Manage Products</title>
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
    <h1>Manage Products</h1>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <h2>Add Product</h2>
    <form method="POST">
        <input type="hidden" name="action" value="insert">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br>
        
        <label for="product_description">Product Description:</label>
        <input type="text" id="product_description" name="product_description" required><br>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br>

        <label for="image_link">Image Link:</label>
        <input type="text" id="image_link" name="image_link" required><br>
        
        <button type="submit">Add Product</button>
    </form>

    <h2>Update Product</h2>
    <form method="POST">
        <input type="hidden" name="action" value="update">
        <label for="id">Product ID:</label>
        <input type="text" id="id" name="id" required><br>
        
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br>
        
        <label for="product_description">Product Description:</label>
        <input type="text" id="product_description" name="product_description" required><br>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br>

        <label for="image_link">Image Link:</label>
        <input type="text" id="image_link" name="image_link" required><br>
        
        <button type="submit">Update Product</button>
    </form>

    <h2>Delete Product</h2>
    <form method="POST">
        <input type="hidden" name="action" value="delete">
        <label for="id">Product ID:</label>
        <input type="text" id="id" name="id" required><br>
        
        <button type="submit">Delete Product</button>
    </form>
</body>
</html>
