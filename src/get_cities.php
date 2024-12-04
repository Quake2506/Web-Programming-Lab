<?php
if (isset($_GET['country_id'])) {
    $country_id = $_GET['country_id'];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "web_prog_lab", 3307);

    $query = "SELECT * FROM cities WHERE country_id = $country_id";
    $result = $conn->query($query);
    echo '<option value="">Select City</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}
?>
