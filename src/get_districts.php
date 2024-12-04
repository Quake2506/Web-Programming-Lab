<?php
if (isset($_GET['city_id'])) {
    $city_id = $_GET['city_id'];
    // Create connection
    $conn = new mysqli("localhost", "root", "", "web_prog_lab", 3307);
    $query = "SELECT * FROM districts WHERE city_id = $city_id";
    $result = $conn->query($query);
    echo '<option value="">Select District</option>';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}
?>
