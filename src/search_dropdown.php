<?php
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "web_prog_lab", 3307);

    $query = "SELECT * FROM products WHERE product_name LIKE '$query%' AND product_description != 'Products' LIMIT 10";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<a href="?page=product_info&id=' . $row['id'] . '">' . $row['product_name'] . '</a>';
        }
    } else {
        echo '<a href="#">No results found</a>';
    }
}

$conn->close();
?>
