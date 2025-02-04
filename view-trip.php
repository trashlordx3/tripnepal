<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="index.css">
    <style>
        .gallery img {
            width: 400px;
            height: 300px;
            cursor: pointer;
            margin: 5px;
        }

        /* Custom modal size */
        .modal-dialog {
            max-width: 80%;
            /* Increase the width of the modal */
            max-height: 90vh;
            /* Increase the height of the modal */
        }


        /* Ensure the modal image fits within the modal */
        .modal-body img {
            max-width: 100%;
            max-height: 70vh;
            /* Adjust based on your needs */
            object-fit: contain;
            /* Ensures the image fits without distortion */
        }

        /* Adjust the close button position */
        .btn-close {
            background-color: green;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1;
        }

        .img-fluid {
            width: 1000px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    include("frontend/header.php");
    ?>
    <div class="features">
        <div class="container py-5">

        </div>
    </div>
    <div class="features">
        <div class="container py-5">
            <div class="trip-image-container">
                <!-- Product Images -->
                <div class="gallery">
                    <img src="assets/img/budget.jpg" class="thumbnail" onclick="openModal(0)">
                    <img src="assets/img/chitwan.jpg" class="thumbnail" onclick="openModal(1)">
                    <img src="assets/img/culture.jpg" class="thumbnail" onclick="openModal(2)">
                </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                <button class="btn btn-dark" onclick="prevImage()">❮</button>
                                <img id="modal-img" src="" class="img-fluid">
                                <button class="btn btn-dark" onclick="nextImage()"> ❯</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    let images = ["assets/img/budget.jpg", "assets/img/chitwan.jpg", "assets/img/culture.jpg"];
                    let currentIndex = 0;

                    function openModal(index) {
                        currentIndex = index;
                        let modalImg = document.getElementById("modal-img");
                        modalImg.src = images[currentIndex];
                        let modal = new bootstrap.Modal(document.getElementById('imageModal'));
                        modal.show();
                    }

                    function prevImage() {
                        currentIndex = (currentIndex - 1 + images.length) % images.length;
                        document.getElementById("modal-img").src = images[currentIndex];
                    }

                    function nextImage() {
                        currentIndex = (currentIndex + 1) % images.length;
                        document.getElementById("modal-img").src = images[currentIndex];
                    }
                </script>
            </div>
            <div class="viewtrip-container">
                <div class="trip-info">
                    <div class="trip-facts"></div>
                    <div class="itinery-menu"></div>
                    <div class="overview"></div>
                    <div class="itinerary"></div>
                    <div class="cost"></div>
                    <div class="dates"></div>
                    <div class="faqs"></div>
                    <div class="map"></div>
                    <div class="review"></div>
                    <div class="enquiry-form"></div>
                </div>
                <div class="trip-pricing">
                    <div class="check-ins"></div>
                    <div class="trip-fact-right"></div>
                </div>
            </div>
            <div class="related-trips">

            </div>
        </div>
    </div>






    <?php
    include("frontend/footer.php");
    ?>
    <div class="scroll-up" id="scrollUpButton" onclick="scrollToTop()">
        <i class="fas fa-chevron-up"></i>
    </div>
    <script>
        window.onscroll = function () {
            var scrollUpButton = document.getElementById("scrollUpButton");
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollUpButton.style.display = "flex";
            } else {
                scrollUpButton.style.display = "none";
            }
        };

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>