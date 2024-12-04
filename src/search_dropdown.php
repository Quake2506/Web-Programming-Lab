<?php
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "web_prog_lab", 3307);

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ? AND product_description != 'Products' LIMIT 10");
    $search_term = "%".$query."%";
    $stmt->bind_param("s", $search_term);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

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
