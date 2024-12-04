<?php

// Retrieve the search query from the form
$search_query = $_GET['query'];

// Prevent SQL injection by using a prepared statement
$stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
$search_term = "%".$search_query."%";
$stmt->bind_param("s", $search_term);

// Execute the statement
$stmt->execute();
$result = $stmt->get_result();

// Display results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    <?php
        include './views/search_form.php';
    ?>
    <div class="container mt-5">
        <?php
        
        if ($result->num_rows > 0) {
            echo '<div class="container-fluid d-flex flex-row flex-wrap justify-content-center align-items-center">';
            
            $display_id = 1;
            while($row = $result->fetch_assoc()) {
                echo'<div class="card m-5 d-flex flex-column" style="width: 20rem; border:none;">';
                echo '<img class="card-img-top" src="'. $row['image_link'] .'"></img>';
                echo '<p class="h5 fw-light">'. $display_id .'. '. $row['product_name'] .'</p>';
                echo '</div>';
                $display_id = $display_id+1;
            }
            echo '</div>';
        } else {
            echo "No results found.";
        }
        ?>
    </div>
</body>
</html>
