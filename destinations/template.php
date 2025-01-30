<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="../index.css">
    <style>
        .head-section,
        .trips-section {
            width: 100%;
            height: max-content;
            align-items: center;
            padding: 10px 80px 10px 80px;
        }

        .page-header {
            padding-top: 50px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .container {
            max-width: 1200px;
            font-size: 24px;
            margin: 0 auto;
        }

        .sort-container {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: flex-start;
            padding: 10px;
        }

        .sort-container .sort-text {
            margin-right: 5px;
            color: #6c757d;
        }

        .sort-container .dropdown-toggle {
            color: #000;
            text-decoration: none;
        }

        .sort-container .view-icons {
            display: flex;
            align-items: center;
            margin-left: 0px;
        }

        .sort-container .view-icons i {
            margin-left: 10px;
            cursor: pointer;
        }


        .trip-container {
            display: grid;
            column-count: 2;
        }

        .card {
            border: none;
            /* Remove default border */
        }

        .card-header {
            border-radius: 0;
            /* Remove rounded corners for header */
        }

        .badge {
            font-size: 0.9rem;
            /* Adjust badge size */
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background for captions */
            border-radius: 5px;
            padding: 10px;
        }
    </style>
</head>
<?php
include("../frontend/header.php");
?>
<section class="head-section">
    <div class="page-header">
        <h1>Destinations</h1>
    </div>
</section>
<section class="trips-section">
    <div class="sort-bar">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sort-container">
                        <span class="sort-text">Sort:</span>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Latest
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Latest</a></li>
                                <li><a class="dropdown-item" href="#">Oldest</a></li>
                                <li><a class="dropdown-item" href="#">Popular</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section class="trips-section">
    <div class="trips-container">
        <?php
        for ($i = 0; $i < 4; $i++) {
            ?>
            <div class="container d-flex justify-content-center align-items-center vh-100">
                <div class="card shadow" style="width: 500px;">
                    <!-- Carousel Section -->
                    <div id="destinationCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <img src="https://cdn.kimkim.com/files/a/content_articles/featured_photos/4a8eeecd5c9854938f39e98a5144100052e91af8/big-913b6140c12e08ffc98f736f2c99bb9b.jpg"
                                    class="d-block w-100" alt="Destination 1">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Destination 1</h5>
                                    <p>Beautiful beaches and clear waters.</p>
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <img src="https://nepalbasecamptreks.com/wp-content/uploads/2024/07/kathmandu-City-Tour-1.webp"
                                    class="d-block w-100" alt="Destination 2">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Destination 2</h5>
                                    <p>Explore the lush green mountains.</p>
                                </div>
                            </div>
                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <img src="https://admin.ntb.gov.np/image-cache/History_tk_aboutnepal_(2)-1629968639.jpg?p=main&s=ac3225480c0290d3fd1ef8ca3a49feaf"
                                    class="d-block w-100" alt="Destination 3">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Destination 3</h5>
                                    <p>Experience the vibrant local culture.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#destinationCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#destinationCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <!-- Tour Details Section -->
                    <div class="card-header bg-primary text-white">
                        <span class="badge bg-secondary">Featured</span>
                        <h1 class="h4 mt-2">7 Days tour to Explore the Kathmandu-City</h1>
                        <div class="mt-2">
                            <p class="mb-1"><strong>@ Kathmandu-City-Tour-1</strong></p>
                            <p class="mb-0"><strong>@ 7 Days</strong></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h2 class="h5 mb-3">Next Departure</h2>
                        <div class="d-flex flex-column gap-2">
                            <span class="text-muted">January 26, 2025</span>
                            <span class="text-muted">January 27, 2025</span>
                        </div>
                    </div>
                    <button class="btn btn-success position-absolute bottom-0 end-0 m-3">Show Trip</button>
                </div>
            </div>
        <?php } ?>
    </div>

</section>

<?php
include("../frontend/footer.php");
?>
<?php
include("../frontend/scrollup.html");
?>/
<script src=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>