<?php
// Check if the product ID is set in the URL
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    // Check if the product exists
    if ($result->num_rows > 0) {
        // Fetch the product information
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Product Information</title>
            <style>
                
            </style>
        </head>
        <body>
            <div class="container-fluid d-flex flex-row flex-wrap justify-content-center align-items-center">
                <div class="card m-5 d-flex flex-column" style="width: 20rem; border:none;">
                    <h2><?php echo htmlspecialchars($row['product_name']); ?></h2>
                    <?php echo '<img class="card-img-top" src="'. $row['image_link'] .'"></img>';?>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['product_description']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($row['price']); ?></p>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID specified.";
}

$conn->close();
?>
