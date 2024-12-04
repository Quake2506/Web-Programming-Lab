<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Form</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff;
            width: 100%;
            overflow: auto;
            z-index: 1;
            border: 1px solid #ddd;
        }
        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .show {
            display: block;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('input[name="query"]').on('keyup', function(){
                var query = $(this).val();
                if (query !== '') {
                    $.ajax({
                        url: "search_dropdown.php",
                        method: "GET",
                        data: {query: query},
                        success: function(data){
                            $('#dropdown').html(data);
                            $('#dropdown').addClass('show');
                        }
                    });
                } else {
                    $('#dropdown').removeClass('show');
                }
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $('#dropdown').removeClass('show');
                }
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5" style="width: 50%;">
        <form action="?page=search" method="GET" class="form-inline">
            <input type="hidden" name="page" value="search">
            <div class="d-flex">
                <div class="input-group ">
                    <input type="text" class="form-control" placeholder="Search..." name="query" aria-label="Search" autocomplete="off" >
                    <div class="dropdown-content" style="margin-top:50px" id="dropdown"></div>
                    
                </div>
                    <button class="btn navButton d-none d-md-block " type="submit">Search</button>
            </div>
            
        </form>
    </div>
</body>
</html>
