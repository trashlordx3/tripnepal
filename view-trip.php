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
            width: 200px;
            height: 100px;
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

        .trip-info {
            display: flex;
            flex-direction: column;
            gap: 50px;
        }

        .trip-facts {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-row-gap: 20px;
            grid-column-gap: 100px;
        }


        #fact-icon {
            color: green;
            margin-right: 5px;
        }

        .itinery-menu {
            border-bottom: 1px solid gray;
            padding: 10px 20px 10px 10px;
            margin-top: 20px;
            width: 100%;
            display: flex;
            gap: 4rem;

        }

        .itinery-menu a {
            text-decoration: none;
            color: black;

        }

        .overview {
            margin-top: 10px;
        }

        #check-icon {
            color: aqua;
            margin-right: 10px;
        }

        .sticky-menu {
            margin-top: 40px;
            height: 50px;
            justify-content: center;
            align-items: center;
            border: none;
            transition: all 0.s ease-in-out;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            z-index: 10000;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            /* Optional: Adds a shadow */
            padding: 10px;
        }

        .faq-head {
            display: flex;
            justify-content: space-between;
        }


        .accordion-button {
            font-weight: bold;
            color: #333;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e9ecef;
            color: #000;
        }

        .accordion-body {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
        }


        @media(max-width:768px) {

            .gallery img {
                height: 100px;
                width: 170px;
            }

            .trip-facts {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-row-gap: 20px;
                grid-column-gap: 40px;


            }

            .itinery-menu {
                gap: 10px;
            }

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
            <div class="features">
                <div class="container py-5">
                    <div class="viewtrip-container" style="width: 100%;">
                        <div class="trip-info" style="width:70%">
                            <div class="trip-heading" style="display: flex;">
                                <h1>7 Days touur to Explore the Beauuty of Himalaya</h1>
                                <div class="duration" style="text-align:center; display:flex; flex-direction:column;">
                                    <h1 style="background-color:aqua; border-radius:5px 5px 0px 0px; color:white;">7
                                    </h1>
                                    <h1 style="margin-top:-5px;">Days</h1>
                                </div>
                            </div>
                            <div class="trip-facts">
                                <div class="flex items-center" ">
                                    <div><i class=" fas fa-bus text-teal-500 mr-2" id="fact-icon"></i>
                                    <span>Transportation</span>
                                </div>
                                <div class=""><span>Bus, Airlines</span></div>

                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-hotel text-teal-500 mr-2"
                                        id="fact-icon"></i><span>Accomodation</span></div>
                                <div class=""><span>3 Stars Hotels</span></div>
                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-mountain text-teal-500 mr-2" id="fact-icon"></i><span>Maximum
                                        Altitude</span>
                                </div>
                                <div class=""><span>5,416 metres</span></div>
                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-plane-departure text-teal-500 mr-2"
                                        id="fact-icon"></i><span>Departure
                                        from</span></div>
                                <div class=""><span>Kathmandu</span></div>
                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-calendar-alt text-teal-500 mr-2" id="fact-icon"></i><span>Best
                                        season</span></div>
                                <div><span>Feb, Mar, Apr & May</span></div>
                            </div>
                            <div class="flex items-center">
                                <div> <i class="fas fa-hiking text-teal-500 mr-2" id="fact-icon"></i><span>Tour
                                        type</span></div>

                                <div class=""><span>Eco-Tour, Hiking</span></div>

                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-utensils text-teal-500 mr-2" id="fact-icon"></i><span>Meals</span>
                                </div>
                                <div class=""><span>All meals during the trek</span></div>
                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-language text-teal-500 mr-2"
                                        id="fact-icon"></i><span>Language</span></div>
                                <div class=""><span>English, Spanish, French, Chinese</span></div>

                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-dumbbell text-teal-500 mr-2" id="fact-icon"></i> <span>Fitness
                                        level</span>
                                </div>
                                <div class=""><span>Easy to Moderate</span></div>

                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-users text-teal-500 mr-2" id="fact-icon"></i><span>Group
                                        Size</span></div>
                                <div class=""><span>2-15</span></div>

                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-child text-teal-500 mr-2" id="fact-icon"></i><span>Minimum
                                        Age</span></div>
                                <div class=""><span>12</span></div>
                            </div>
                            <div class="flex items-center">
                                <div><i class="fas fa-user-alt text-teal-500 mr-2" id="fact-icon"></i><span>Maximum
                                        Age</span>
                                </div>
                                <div class=""><span>65</span></div>
                            </div>
                        </div>
                        <div class="itinery-menu">
                            <a href="#overview" onclick="setActiveMenuItem(0)">overview</a>
                            <a href="#itinerary" onclick="setActiveMenuItem(1)">Itinerary</a>
                            <a href="#cost" onclick="setActiveMenuItem(2)">Cost</a>
                            <a href="#faqs" onclick="setActiveMenuItem(3)">FAQs</a>
                            <a href="#map" onclick="setActiveMenuItem(4)">Map</a>
                            <a href="#enquiry" onclick="setActiveMenuItem(5)">Enquiry</a>
                        </div>
                        <div class="overview" id="overview">
                            <h2>Overview</h2>
                            <p>Travel is the movement of people between relatively distant geographical locations, and
                                can involve travel by foot, bicycle, automobile, train, boat, bus, airplane, or other
                                means, with or without luggage, and can be one way or round trip. Travel can also
                                include relatively short stays between successive movements.

                                The origin of the word “travel” is most likely lost to history. The term “travel” may
                                originate from the Old French word travail, which means ‘work’. According to the Merriam
                                Webster dictionary, the first known use of the word travel was in the 14th century.</p>
                            <h2>
                                Hightlights
                            </h2>
                            <i class="fas fa-check" id="check-icon"></i><span>Treck to the world-famous Everest Base
                                Camp</span><br>
                            <i class="fas fa-check" id="check-icon"></i><span>Treck to the world-famous Everest Base
                                Camp</span><br>
                            <i class="fas fa-check" id="check-icon"></i><span>Treck to the world-famous Everest Base
                                Camp</span><br>
                        </div>
                        <div class="itinerary" id="itinerary">
                            <div class="faq-head">
                                <div>
                                    <h1>Itinerary</h1>
                                </div>

                                <div style="display:flex; gap:10px;">
                                    <span>Expand all</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault" style="border:1px solid #2a7d7d;">
                                    </div>
                                </div>

                            </div>
                            <div class="accordion" id="faqAccordion">
                                <!-- FAQ Item 1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" style="z-index:0;">
                                            Day 1 : Kathmandu to Pokhara (By flight or Bus).
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Arrive at Tribhuwan International Airport, Kathmandu, you are welcomed by
                                            the team and then you will be transferred to your hotel. This trail goes
                                            through Ghorepani Poon Hill. Normally, the trek starts like Pokhara to
                                            Nayapul and ends like Phedi to Pokhara. While early travel tended to be
                                            slower, more dangerous, and more dominated by trade and migration, cultural
                                            and technological advances over many years have tended to mean that travel
                                            has become easier and more accessible. The evolution of technology in such
                                            diverse fields as horse tack and bullet trains has contributed to this
                                            trend.
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item 2 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                            Day 2 : Drive to Nayapul and trek to Ulleri
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            We cover a wide range of destinations, including Kathmandu, Pokhara,
                                            Lumbini, Mustang, Chitwan, and
                                            Solukhumbu. Explore our website for more details.
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item 3 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                            Day 3 : Trek to Ghorepani
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Yes, we specialize in affordable travel packages, including budget
                                            accommodations, local transport, and
                                            cost-effective tours.
                                        </div>
                                    </div>
                                </div>
                                <!-- FAQ Item 4 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                            Day 4 : Early trek to Poon Hill, Back to Ghorepani and trek to tadapani
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Absolutely! We offer customizable itineraries to suit your preferences,
                                            whether you're looking for
                                            adventure, relaxation, or cultural experiences.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

            </div>
        </div>
        <div class="features">
            <div class="container py-5">
                <div class="related-trips">

                </div>
            </div>
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
        document.addEventListener("DOMContentLoaded", function () {
            const menu = document.querySelector(".itinery-menu");
            const menuOffset = menu.offsetTop; // Get original position of menu

            window.addEventListener("scroll", function () {
                if (window.pageYOffset >= menuOffset) {
                    menu.classList.add("sticky-menu"); // Stick to the top
                } else {
                    menu.classList.remove("sticky-menu"); // Remove sticky effect
                }
            });
        });

        //Function to set the active menu item
        function setActiveMenuItem(activeIndex) {
            const menuItems = document.querySelectorAll('.itinery-menu a'); // Select all menu links

            menuItems.forEach((item, index) => {
                if (index === activeIndex) {
                    item.classList.add('active-menu'); // Add active class
                } else {
                    item.classList.remove('active-menu'); // Remove active class
                }
            });
        }

        // Set the first menu item (Overview) as active by default
        setActiveMenuItem(0);

        // Example: Set the first menu item (Overview) as active by default
        setActiveMenuItem();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>