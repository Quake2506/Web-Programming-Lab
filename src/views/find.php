<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Our Store</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <style>
        #map {
            height: 500px;
            width: 100%;
            margin-bottom: 20px; /* Add margin to prevent overlay */
        }
        #locationDetails {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <form>
            <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" id="country" name="country">
                    <option value="">Select Country</option>
                    <?php
                    // Fetch countries from the database
                    $query = "SELECT * FROM countries";
                    $result = $conn->query($query);
                    while($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city" disabled>
                    <option value="">Select City</option>
                </select>
            </div>
            <div class="form-group">
                <label for="district">District</label>
                <select class="form-control" id="district" name="district" disabled>
                    <option value="">Select District</option>
                </select>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#country').change(function() {
                var country_id = $(this).val();
                console.error();
                $('#city').html('<option value="">Select City</option>').prop('disabled', true);
                $('#district').html('<option value="">Select District</option>').prop('disabled', true);
                if (country_id) {
                    $.ajax({
                        url: 'get_cities.php',
                        type: 'GET',
                        data: {country_id: country_id},
                        success: function(data) {
                            console.log(data);
                            $('#city').html(data).prop('disabled', false); // Enable city dropdown
                        }
                    });
                }
            });

            $('#city').change(function() {
                var city_id = $(this).val();
                $('#district').html('<option value="">Select District</option>').prop('disabled', true);
                if (city_id) {
                    $.ajax({
                        url: 'get_districts.php',
                        type: 'GET',
                        data: {city_id: city_id},
                        success: function(data) {
                            $('#district').html(data).prop('disabled', false); // Enable district dropdown
                        }
                    });
                }
            });
        });
    </script>
    <div class="container mt-5">
        <h2>Location Search</h2>
        <form id="locationForm">
            <div class="form-group ">
                <label for="location">Search for a location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter a location" >
            </div>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <button type="button" class="btn navButton d-none d-md-block mt-3 mb-3" onclick="searchLocation()">Submit</button>
        </form>
        <div id="map"></div>
        <div id="locationDetails"></div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([10.762622, 106.660172], 13); // Default location (Ho Chi Minh City)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        // Function to search location and update map
        function searchLocation() {
            var location = document.getElementById('location').value;
            console.log('Searching for:', location); // Debugging: Log the search term
            if (location.length > 3) { // Start searching when input is more than 3 characters
                fetch('https://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + encodeURIComponent(location))
                    .then(response => {
                        console.log('Response Status:', response.status); // Debugging: Log the response status
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched Data:', data); // Debugging: Log the fetched data
                        if (data && data.length > 0) {
                            var firstResult = data[0];
                            var lat = firstResult.lat;
                            var lon = firstResult.lon;

                            console.log('Latitude:', lat);
                            console.log('Longitude:', lon);

                            document.getElementById('latitude').value = lat;
                            document.getElementById('longitude').value = lon;
                            document.getElementById('location').value = firstResult.display_name; // Display the address

                            // Update map and add popup with address
                            if (marker) {
                                map.removeLayer(marker);
                            }
                            marker = L.marker([lat, lon]).addTo(map)
                                .bindPopup(firstResult.display_name)
                                .openPopup();
                            map.setView([lat, lon], 13);
                        } else {
                            console.error('No results found');
                        }
                    })
                    .catch(error => console.error('Error fetching location:', error));
            }
        }
    </script>
</body>
</html>

