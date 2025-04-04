<?php
include("frontend/session_start.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="assets/css/view-trip.css">

</head>

<body>
    <?php
    include("frontend/header.php");
    ?>
    <div class="features">
        <div class="container py-5">
            <div class="trip-image-container">
                <!-- Product Images -->
                <div class="gallery" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
                    <img src="assets/img/budget.jpg" class="thumbnail" onclick="openModal(0)"
                        style="height: 300px; width: 400px;">
                    <img src="assets/img/chitwan.jpg" class="thumbnail" onclick="openModal(1)"
                        style="height: 300px; width: 400px;">
                    <img src="assets/img/culture.jpg" class="thumbnail" onclick="openModal(2)"
                        style="height: 300px; width: 400px;">
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
                    <div class="viewtrip-container" style="width: 100%; display: flex; justify-content: space-between;">
                        <div class="trip-info" style="width:68%">
                            <div class="trip-heading" style="display: flex;">
                                <h1>7 Days touur to Explore the Beauuty of Himalaya</h1>
                                <div class="duration" style="text-align:center; display:flex; flex-direction:column;">
                                    <h1
                                        style="background-color:rgb(83, 192, 192); border-radius:5px 5px 0px 0px; color:white;">
                                        7
                                    </h1>
                                    <h1 style="margin-top:-5px;">Days</h1>
                                </div>
                            </div>
                            <div class="trip-facts" id="menu">
                                <div class="flex items-center" ">
                                    <div><i class=" fas fa-bus text-teal-500 mr-2" id="fact-icon"></i>
                                    <span>Transportation</span>
                                </div>
                                <div class=""><span>Bus, Airlines</span></div>
                            </div>

                            <div class="flex items-center">
                                <div><i class="fas fa-hotel text-teal-500 mr-2"
                                        id="fact-icon"></i><span>Accomodation</span>
                                </div>
                                <div class=""><span>3 Stars Hotels</span>
                                </div>
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
                            <a href="#menu" onclick="setActiveMenuItem(0)">Overview</a>
                            <a href="#overview" onclick="setActiveMenuItem(1)">Itinerary</a>
                            <a href="#itinerary" onclick="setActiveMenuItem(2)">Cost</a>
                            <a href="#cost" onclick="setActiveMenuItem(3)">FAQs</a>
                            <a href="#faqs" onclick="setActiveMenuItem(4)">Map</a>
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
                            <div class="itinerary-container">
                                <div class="itinerary-header">
                                    <span>
                                        <h1>Itinerary</h1>
                                    </span>
                                    <div class="toggle-container">
                                        <label class="toggle-label">Expand All</label>
                                        <div class="toggle-switch" onclick="toggleAll()"></div>
                                    </div>
                                </div>

                                <div class="day">
                                    <div class="day-header" onclick="toggleDay(this)">
                                        <span><strong>Day 1: Kathmandu to Pokhara (By flight or Bus)</strong></span>
                                        <span class="icon">⌄</span>
                                    </div>
                                    <div class="day-content">
                                        <p>Arrive at Tribhuwan International Airport, Kathmandu. You are welcomed by the
                                            team and then transferred
                                            to your hotel. This trail goes through Ghorepani Poon Hill.
                                        </p>
                                    </div>
                                </div>

                                <div class="day">
                                    <div class="day-header" onclick="toggleDay(this)">
                                        <span><strong>Day 2: Drive to Nayapul and trek to Ulleri</strong></span>
                                        <span class="icon">⌄</span>
                                    </div>
                                    <div class="day-content">
                                        <p> Drive to Nayapul and begin your trek Lorem ipsum dolor, sit amet consectetur
                                            adipisicing elit. Suscipit molestiae libero similique ratione laboriosam
                                            alias
                                            neque exercitationem officia, fuga voluptates facere a dignissimos rerum
                                            accusamus blanditiis molestias aliquid quos esse! to Ulleri, passing through
                                            lush
                                            landscapes
                                            and small villages.
                                        </p>
                                    </div>
                                </div>

                                <div class="day">
                                    <div class="day-header" onclick="toggleDay(this)">
                                        <span><strong>Day 3: Trek to Ghorepani</strong></span>
                                        <span class="icon">⌄</span>
                                    </div>
                                    <div class="day-content">
                                        <p>
                                            Continue your trek through rhododendron forests to reach the beautiful
                                            village
                                            of Ghorepani.
                                        </p>
                                    </div>
                                </div>

                                <div class="day">
                                    <div class="day-header" onclick="toggleDay(this)">
                                        <span><strong>Day 4: Early trek to Poon Hill, Back to Ghorepani and trek to
                                                Tadapani</strong></span>
                                        <span class="icon">⌄</span>
                                    </div>
                                    <div class="day-content">
                                        <p>
                                            An early morning trek to Poon Hill for a breathtaking sunrise view, then
                                            return
                                            to Ghorepani and proceed
                                            to Tadapani.
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="cost" id="cost">
                            <h1>Cost</h1>
                            <h3>
                                The Cost Includes
                            </h3>
                            <?php for ($i = 0; $i < 5; $i++) { ?>

                                <i class="fas fa-check" id="check-icon"></i><span>Pick-up or Drop-off service from and
                                    to Airport(in our own vehicle)</span><br>

                            <?php } ?>
                            <br><br>
                            <h3>The Cost Excludes</h3>
                            <?php for ($i = 0; $i < 5; $i++) { ?>

                                <i class="fas fa-times" id="cross-icon"></i><span>Pick-up or
                                    Drop-off service from
                                    and
                                    to Airport(in our own vehicle)</span><br>
                            <?php } ?>

                        </div>
                        <div class="dates" id="dates">

                        </div>
                        <div class="faqs" id="faqs">
                            <div class="faq-container">
                                <div class="itinerary-header">
                                    <span>
                                        <h1>FAQ's</h1>
                                    </span>
                                </div>
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <div class="day">
                                        <div class="day-header" onclick="toggleDay(this)">
                                            <span><strong>How to Book Trip</strong></span>
                                            <span class="icon">⌄</span>
                                        </div>
                                        <div class="day-content">
                                            <p>Use the form</p>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        <div class="map" id="map">
                            <h1>Map</h1><br>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.451214129912!2d85.32396061544552!3d27.717245982788245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1901cb67d5a1%3A0x6e8daaf9ed44a6a!2sKathmandu!5e0!3m2!1sen!2snp!4v1613561252925!5m2!1sen!2snp"
                                allowfullscreen="" loading="fast" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <div class="review" id="review"></div>
                        <div class="enquiry-form" id="enquiry-form">
                            <h1>Enquiry Form</h1>
                            <div class="enquiry-container">
                                <h1>You can send your enquiry via the form below.</h1>
                                <form id="enquiryForm">
                                    <label for="trip-name">Trip name: <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="trip-name" placeholder="Enter Your Name *"
                                        required value="Ghorepani Poon Hill Trek">
                                    <label for="name">Your name: <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" placeholder="Enter Your Name *" required>
                                    <label for="email">Your email: <span style="color: red;">*</span></label>
                                    <input type="email" id="email" name="email" placeholder="Enter Your Email *"
                                        required>

                                    <div class="row">
                                        <div class="col-half">
                                            <label for="country">Country <span style="color: red;">*</span></label>
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
                                            <label for="contact-number">Contact number: <span
                                                    style="color: red;">*</span></label>
                                            <input type="text" id="contact-number" name="contact-number"
                                                placeholder="Enter Your Contact Number*" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-half">
                                            <label for="adults">No. of Adults <span style="color: red;">*</span></label>
                                            <input type="number" id="adults" name="adults"
                                                placeholder="Enter Number of Adults*" required>
                                        </div>
                                        <div class="col-half">
                                            <label for="children">No. of children</label>
                                            <input type="number" id="children" name="children"
                                                placeholder="Enter Number of Children">
                                        </div>
                                    </div>

                                    <label for="subject">Enquiry Subject: <span style="color: red;">*</span></label>
                                    <input type="text" id="subject" name="subject" placeholder="Enquiry Subject"
                                        required>

                                    <label for="message">Your Message <span style="color: red;">*</span></label>
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
                        <div class="check-ins" style="width:330px;">
                            <div class="price-head">
                                <h3>Price</h3>
                            </div>
                            <div class="pricing"
                                style="text-align: center; display:flex; justify-content:space-evenly; padding:15px 0px 15px 0px;">
                                <div class="price1">
                                    <span style="color: black;">From </span> <span
                                        style="font-size: 2rem;">$300</span><span style="color: black;">/Person</span>
                                </div>
                            </div>
                            <div class="highlite"
                                style="margin:10px 0px 10px 0px; padding-bottom:2rem; padding-left:10px;">
                                <i class="fas fa-check" id="check-icon"></i><span>Best Price Guaranteed</span><br>
                                <i class="fas fa-check" id="check-icon"></i><span>No Booking Fees</span><br>
                                <i class="fas fa-check" id="check-icon"></i><span>Professional Guides</span><br>
                            </div>
                            <div class="trip-fact-right" style="padding-left: 10px;">
                                <h4>Next Departure:</h4>
                                <ul style=" list-style-type: none;">
                                    <li>Jan 2025</li>
                                    <li>Feb 2025</li>
                                    <li>March 2025</li>
                                    <li>April 2025</li>
                                </ul>
                            </div>
                            <div class="action" style="display: flex; justify-content: space-between;">
                                <a href="book-trip" class="pricing-btn"><i
                                        class="fas fa-ticket-alt text-teal-500 mr-2"></i>
                                    Book Now
                                </a>
                            </div>
                            <div style="text-align: center;padding:20px 0px 10px 0px;">
                                <p>Need help in booking ? <a href="#enquiry-form" style="text-decoration: none;">Enquiry
                                        Now</a></p>
                            </div>
                        </div>

                        <div class="trip-fact-right" style="height: 100px;">

                            <div class="side-trip-facts"
                                style="display: flex; flex-direction: column; grid-row-gap:30px; padding:30px 0px 0px 30px;">
                                <div class="flex items-center">
                                    <div><i class=" fas fa-bus text-teal-500 mr-2"
                                            id="fact-icon"></i><span>Transportation</span>
                                    </div>
                                    <div class=""><span>Bus, Airlines</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div><i class="fas fa-hotel text-teal-500 mr-2"
                                            id="fact-icon"></i><span>Accomodation</span>
                                    </div>
                                    <div class=""><span>3 Stars Hotels</span>
                                    </div>
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
                                    <div><i class="fas fa-utensils text-teal-500 mr-2"
                                            id="fact-icon"></i><span>Meals</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="features">
            <div class="container text-left py-5">
                <h1>Explore Related trips</h1>
            </div>
        </div>

        <div class="features">
            <div class="container text-center py-5 card-container" id="card-container"
                style="row-gap:20px; background-color:transparent;">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <div class="card" style=" flex: 0 0 calc(33.33% - 20px);">
                        <div class="position-relative">
                            <div class="carousel">
                                <div class="carousel-container">
                                    <a href="">
                                        <img src="assets/img/mustang.jpg" class="slide active">
                                    </a>
                                </div>
                            </div>
                            <span class="badge-featured">
                                Featured
                            </span>
                        </div>
                        <div class="card-top">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center"
                                    style="padding:10px 0px 10px 0px">
                                    <a href="" style="text-decoration:none; color:black;"
                                        onmouseover="this.style.color='#008080'" onmouseout="this.style.color='black'">
                                        <h5 class=" card-title mb-0">
                                            Paris Effiel Tower Tour 1 Day Tour
                                        </h5>
                                    </a>

                                </div>
                                <div>
                                    <div class=" d-flex mb-3">
                                        <div class="me-3 card-contents" style="padding-left:15px;">
                                            <p class="mb-1">
                                                <i class="fas fa-map-marker-alt" style="color:green; margin-right:10px;">
                                                </i>
                                                France, India, Nepal, Srilanka
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-clock" style="color:green; margin-right:5px;">
                                                </i>
                                                5 Hours
                                            </p>
                                            <p class="mb-1">
                                                <i class="fas fa-users" style="color:green; margin-right:2px;">
                                                </i>
                                                1-10 People
                                            </p>
                                        </div>
                                        <div class="me-3 card-contents">
                                            <div class="price"
                                                style="margin-top:50%; border-left: 1px solid gray; padding-left:20px;">
                                                <h2><?php echo "$" . number_format(3000); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="me-3 card-contents" style="padding:10px 0px 10px 0px;">
                                    <p class="mb-1">
                                        Travel is the movement of people between relatively distant geographical...
                                    </p>
                                </div>
                                <div class="departure-detail"
                                    style="display: flex; align-items:end; justify-content: space-between;">

                                    <div class="me-3 card-contents" style="padding:10px 0px 10px 0px;">
                                        <h5>Next Departure: </h5>
                                        <p class="mb-1">Jan 2025</p>
                                        <p class="mb-1">Jan 2025</p>
                                        <p class="mb-1">Jan 2025</p>
                                    </div>
                                    <div class="me-3 card-contents" id="view-details-link"
                                        style="padding:10px 0px 10px 0px;">
                                        <a href="#">VIEW DETAILS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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
    <!-- for itinerary -->
    <script>
        function toggleDay(element) {
            let day = element.parentElement;
            let content = day.querySelector('.day-content');
            let icon = element.querySelector('.icon');

            if (day.classList.contains("expanded")) {
                content.style.maxHeight = "0";
                content.style.padding = "0 15px";
                day.classList.remove("expanded");
            } else {
                content.style.maxHeight = content.scrollHeight + 20 + "px"; // Dynamically set max-height
                content.style.padding = "10px 15px";
                day.classList.add("expanded");
            }
        }

        function toggleAll() {
            let toggleSwitch = document.querySelector('.toggle-switch');
            let days = document.querySelectorAll('.day');
            let expand = !toggleSwitch.classList.contains("active");

            days.forEach(day => {
                let content = day.querySelector('.day-content');

                if (expand) {
                    content.style.maxHeight = content.scrollHeight + 20 + "px"; // Ensure full visibility
                    content.style.padding = "10px 15px";
                    day.classList.add("expanded");
                } else {
                    content.style.maxHeight = "0";
                    content.style.padding = "0 15px";
                    day.classList.remove("expanded");
                }
            });

            toggleSwitch.classList.toggle("active", expand);
            document.querySelector(".toggle-label").textContent = expand ? "Collapse All" : "Expand All";
        }

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>