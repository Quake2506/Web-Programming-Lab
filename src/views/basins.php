<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basins</title>
    <script>
        <?php
            // Write the SQL query
            $sql = $conn->prepare( "SELECT id, product_name, product_description, price, image_link FROM products WHERE product_description = 'Washbasins'");
            $sql -> execute();
            $sql -> store_result();
            $sql -> bind_result($id, $product_name, $product_description, $price, $image_link);
            while ($sql->fetch()) { 
                $records[] = [ 
                    'id' => $id, 
                    'product_name' => $product_name, 
                    'product_description' => $product_description, 
                    'price' => $price, 
                    'image_link' => $image_link, 
                ]; 
            }
        ?>
    </script>
</head>

<body>
    <?php
        include './views/search_form.php';
    ?>
    <div class="container-fluid d-flex flex-row flex-wrap justify-content-center align-items-center">
                <?php
                    $display_id = 1;
                    foreach ($records as $records) {
                        echo'<a href="?page=product_info&id=' . $records['id'] . '" class="productCard card m-5 d-flex flex-column">';
                        echo '<img class="card-img-top pb-2" src="'. $records['image_link'] .'"></img>';
                        echo '<p class="h5 fw-light">'. $display_id .'. '. $records['product_name'] .'</p>';
                        echo '</a>';
                        $display_id = $display_id+1;
                    }
                ?>
    </div>
</body>
</html>
