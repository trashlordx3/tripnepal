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
            margin-top: 65px;
            height: 50px;
            justify-content: center;
            align-items: center;
            border: none;
            transition: all 0.s ease-in-out;
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
            background: white;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
            /* Optional: Adds a shadow */
            padding: 10px;
        }

        #check-icon {
            background-color: green;
            border-radius: 50%;
            padding: 3px;
        }

        .faq-head {
            display: flex;
            justify-content: space-between;
        }

        .accordion-button {
            z-index: 0;
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

        iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        .enquiry-container {
            max-width: 800px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 700;
            color: #555;
        }

        input,
        select,
        textarea {
            width: 98%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #008080;
            outline: none;
        }

        input[type="submit"] {
            background-color: #008080;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            padding: 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #008080;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-half {
            flex: 1;
            min-width: calc(48% - 10px);
        }

        @media (max-width: 600px) {
            .enquiry-container {
                margin: 10px;
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            .row {
                flex-direction: column;
                gap: 0;
            }

            .col-half {
                min-width: 98%;
            }

            input[type="submit"] {
                width: 100%;
            }
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
                            <i class="fas fa-check" id="check-icon"></i><span>Treck to
                                the world-famous Everest Base
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
                                            data-bs-target="#collapseTwo" id="flexSwitchCheckDefault"
                                            style="border:1px solid #2a7d7d;">
                                    </div>
                                </div>

                            </div>
                            <div class="accordion" id="faqAccordion">
                                <!-- FAQ Item 1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
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

                        <div class="cost">
                            <h1>Cost</h1>
                            <h2>
                                The Cost Includes
                            </h2>
                            <ul style="margin-left:-10px;">
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>Pick-up or Drop-off service from and to
                                        Airport(in our own vehicle)
                                        Camp</p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>Pick-up or Drop-off service from and to
                                        Airport(in our own vehicle)
                                        Camp</p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>Food all along the trip(Breakfast, Lunch,
                                        Dinner and a cup of coffee or tea) and accommodations during the trip in hotels
                                        with
                                        family environment
                                    </p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    ansportation, food, accommodation and
                                    insurance of Guide during the trip

                                    </p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>First Aid Medical Kit(Your guide will
                                        carry the Medical Kit but we also advise to bring yourself for your own use, as
                                        far as
                                        possible)
                                    </p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>All the required permits and paperwork
                                    </p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>Down jacket, all-season sleeping bag,
                                        duffel bag and trekking map(in case if you don’t have your own. Down jacket,
                                        sleeping
                                        bag and duffel bag must be returned after completion of the trip)
                                    </p>
                                </li>
                                <li style="display:flex; list-style-type:none;">
                                    <i class="fas fa-check" id="check-icon"></i>
                                    <p>Transportation to and from!!
                                    </p>
                                </li>
                            </ul>

                        </div>
                        <div class="dates">

                        </div>
                        <div class="faqs">
                            <div class="faq-head">
                                <div>
                                    <h1>Itinerary</h1>
                                </div>

                                <div style="display:flex; gap:10px;">
                                    <span>Expand all</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            data-bs-target="#collapseTwo" id="flexSwitchCheckDefault"
                                            style="border:1px solid #2a7d7d;">
                                    </div>
                                </div>

                            </div>
                            <div class="accordion" id="faqAccordion">
                                <!-- FAQ Item 1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
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
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.451214129912!2d85.32396061544552!3d27.717245982788245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1901cb67d5a1%3A0x6e8daaf9ed44a6a!2sKathmandu!5e0!3m2!1sen!2snp!4v1613561252925!5m2!1sen!2snp"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <div class="review"></div>
                        <div class="enquiry-form">
                            <div class="enquiry-container">
                                <h1>You can send your enquiry via the form below.</h1>
                                <form id="enquiryForm">
                                    <label for="trip-name">Trip name: *</label>
                                    <p id="trip-name">Ghorepani Poon Hill Trek</p>

                                    <label for="name">Your name: *</label>
                                    <input type="text" id="name" name="name" placeholder="Enter Your Name *" required>

                                    <label for="email">Your email: *</label>
                                    <input type="email" id="email" name="email" placeholder="Enter Your Email *"
                                        required>

                                    <div class="row">
                                        <div class="col-half">
                                            <label for="country">Country *</label>
                                            <select id="country" name="country" required onchange="adjustInputSize()">
                                                <option value="">Choose a country*</option>
                                                <option value="USA">United States of America</option>
                                                <option value="UK">United Kingdom</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="France">France</option>
                                                <option value="Japan">Japan</option>
                                                <option value="India">India</option>
                                                <option value="China">China</option>
                                                <option value="Brazil">Brazil</option>
                                            </select>
                                        </div>
                                        <div class="col-half">
                                            <label for="contact-number">Contact number: *</label>
                                            <input type="text" id="contact-number" name="contact-number"
                                                placeholder="Enter Your Contact Number*" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-half">
                                            <label for="adults">No. of Adults *</label>
                                            <input type="number" id="adults" name="adults"
                                                placeholder="Enter Number of Adults*" required>
                                        </div>
                                        <div class="col-half">
                                            <label for="children">No. of children</label>
                                            <input type="number" id="children" name="children"
                                                placeholder="Enter Number of Children">
                                        </div>
                                    </div>

                                    <label for="subject">Enquiry Subject: *</label>
                                    <input type="text" id="subject" name="subject" placeholder="Enquiry Subject"
                                        required>

                                    <label for="message">Your Message *</label>
                                    <textarea id="message" name="message" rows="5" placeholder="Enter Your message*"
                                        required></textarea>

                                    <input type="submit" value="Send Email">
                                </form>
                            </div>

                            <script>
                                // Function to adjust input size based on selected country
                                function adjustInputSize() {
                                    const countrySelect = document.getElementById('country');
                                    const selectedCountry = countrySelect.options[countrySelect.selectedIndex].text;
                                    const contactNumberInput = document.getElementById('contact-number');

                                    // Calculate the width based on the length of the selected country name
                                    const width = Math.min(Math.max(selectedCountry.length * 10, 100), 300); // Min 100px, Max 300px
                                    contactNumberInput.style.width = `${width}px`;
                                }

                                // Form submission handling
                                document.getElementById('enquiryForm').addEventListener('submit', function (event) {
                                    event.preventDefault();

                                    const name = document.getElementById('name').value;
                                    const email = document.getElementById('email').value;
                                    const country = document.getElementById('country').value;
                                    const contactNumber = document.getElementById('contact-number').value;
                                    const adults = document.getElementById('adults').value;
                                    const children = document.getElementById('children').value;
                                    const subject = document.getElementById('subject').value;
                                    const message = document.getElementById('message').value;

                                    if (!validateEmail(email)) {
                                        alert('Please enter a valid email address.');
                                        return;
                                    }

                                    const formData = {
                                        name,
                                        email,
                                        country,
                                        contactNumber,
                                        adults,
                                        children,
                                        subject,
                                        message
                                    };

                                    console.log('Form Data Submitted:', formData);
                                    alert('Your enquiry has been sent successfully!');
                                });

                                // Email validation function
                                function validateEmail(email) {
                                    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    return re.test(String(email).toLowerCase());
                                }
                            </script>
                        </div>
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