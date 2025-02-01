<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="index.css">
   <style>
      .feature-icon {
         background-color: #e0f7fa;
         border-radius: 50%;
         padding: 20px;
         margin-bottom: 20px;
      }

      .feature-title {
         font-weight: bold;
         margin-bottom: 10px;
      }

      .feature-description {
         color: #6c757d;
      }

      /* explore trip */
      .section-title {
         text-align: center;
         padding: 50px 0;
      }

      .section-title h2 {
         font-family: "Pacifico", cursive;
         color: #00a676;
         font-size: 24px;
      }

      .section-title h1 {
         font-weight: 700;
         font-size: 36px;
         color: #000;
      }

      .section-title p {
         color: #666;
         font-size: 16px;
      }

      .section-title .divider {
         margin: 20px auto;
         width: 50px;
         height: 2px;
         background-color: #f4a261;
      }

      /* card */
      .card-container {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;
      }

      .card {
         border: none;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         max-width: 400px;
         max-height: fit-content;

         margin: auto;
      }

      .badge-featured {
         position: absolute;
         top: 10px;
         left: 10px;
         background-color: #ffc107;
         color: #fff;
         padding: 5px 10px;
         border-radius: 5px;
         font-size: 12px;
      }

      .price {
         font-size: 24px;
         font-weight: bold;
         color: black;

      }

      .original-price {
         text-decoration: line-through;
         color: #6c757d;
      }

      .btn-view-details {
         background-color: #fd7e14;
         color: #fff;
         font-weight: bold;
         border-radius: 5px;
      }

      .btn-view-details:hover {
         background-color: #e96b0c;
      }

      .next-departure {
         font-size: 14px;
         color: #6c757d;
      }

      .wishlist-icon {
         color: #dc3545;
         font-size: 20px;
      }


      .carousel {
         position: relative;
         width: 100%;
         overflow: hidden;
         border-radius: 3px;
         box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
      }

      .carousel img {
         height: 300px;
      }

      .carousel-container {
         display: flex;
         transition: transform 0.5s ease-in-out;
      }

      .slide {
         width: 100%;
         display: none;
      }

      .active {
         display: block;
      }

      .prev,
      .next {
         position: absolute;
         top: 50%;
         transform: translateY(-50%);
         background: transparent;
         color: white;
         border: none;
         padding: 10px;
         cursor: pointer;
         font-size: 18px;
         border-radius: 50%;
      }

      .prev {
         left: 10px;
      }

      .next {
         right: 10px;
      }

      #card-container {
         display: grid;
         grid-template-columns: repeat(3, 1fr);
         /* 3 columns */
         gap: 20px;
         /* Spacing between grid items */
         padding: 20px;
         background-color: #f4f4f4;
      }

      /* view more trips */
      .btn-custom {
         border: 1px solid #F4A261;
         color: #F4A261;
         background-color: transparent;
         padding: 10px 20px;
         font-size: 14px;
      }

      .btn-custom:hover {
         background-color: #F4A261;
         color: white;
      }



      @media (max-width: 768px) {
         .card-container {
            grid-template-columns: repeat(1, 1fr);
            /* 1 column for small screens */
         }

         .trips-section {
            padding: none;
            align-items: center;
         }

         #card-container {
            grid-template-columns: 1fr;
         }
      }

      .card-contents {
         text-align: left;
      }

      .trip-card {
         background-color: #fff;
         border: none;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         overflow: hidden;
         transition: transform 0.3s ease;
      }

      .trip-card:hover {
         transform: translateY(-10px);
      }

      .trip-card img {
         width: 100%;
         height: 200px;
         object-fit: cover;
      }

      .trip-card-body {
         padding: 20px;
      }

      .trip-card-title {
         font-size: 1.5rem;
         color: #17252a;
         margin-bottom: 10px;
      }

      .trip-card-text {
         color: #555;
         font-size: 1rem;
         margin-bottom: 15px;
      }

      .trip-card a {
         color: #3aafa9;
         text-decoration: none;
         font-weight: bold;
      }

      .trip-card a:hover {
         text-decoration: underline;
      }

      /* testimonials */
      .carousel-container {
         position: relative;
         width: 100%;
         overflow: hidden;
         border-radius: 8px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
         background: white;
      }

      /* Carousel track */
      .carousel {
         display: flex;
         transition: transform 0.5s ease-in-out;
      }

      /* Each testimonial item */
      .testimonial {
         min-width: 100%;
         flex: 0 0 100%;
         padding: 20px;
         text-align: center;
         background: white;
      }

      /* Testimonial text */
      .testimonial p {
         font-size: 18px;
         line-height: 1.5;
         margin-bottom: 10px;
      }

      .testimonial h4 {
         font-size: 16px;
         color: #555;
      }

      /* Navigation Buttons */
      .carousel-container button {
         position: absolute;
         top: 50%;
         transform: translateY(-50%);
         background: rgba(0, 0, 0, 0.5);
         color: #fff;
         border: none;
         padding: 10px 15px;
         cursor: pointer;
         border-radius: 50%;
         font-size: 18px;
      }

      .carousel-container .prev {
         left: 10px;
         background: none;
      }

      .carousel-container .next {
         right: 10px;
         background: none;
      }

      .carousel-container button:hover {
         background: none;

      }

      .testimonial-container {
         display: flex;
         align-items: center;
         justify-content: center;
         padding: 50px;
         position: relative;
      }

      .testimonial-content {
         margin: 0 auto;
         display: flex;
         gap: 20px;
         align-items: center;
         max-width: 800px;
         text-align: left;
      }

      .testimonial-image {
         position: relative;
         margin-right: 20px;
      }

      .testimonial-image img {
         border-radius: 50%;
         width: 150px;
         height: 150px;
         object-fit: cover;
      }

      .testimonial-image .decorative-icon {
         position: absolute;
      }

      .decorative-icon-1 {
         top: -10px;
         right: -10px;
      }

      .decorative-icon-2 {
         bottom: -10px;
         left: -10px;
      }

      .testimonial-text {
         max-width: 500px;
      }

      .testimonial-text h5 {
         color: #00bfa5;
         font-size: 24px;
      }

      .testimonial-text h3 {
         font-size: 24px;
         font-weight: bold;
         margin-top: 10px;
      }

      .testimonial-text p {
         font-size: 16px;
         color: #333;
         margin-top: 10px;
      }

      .testimonial-text .author {
         font-size: 16px;
         font-weight: bold;
         margin-top: 10px;
      }

      .testimonial-navigation {
         position: absolute;
         top: 50%;
         transform: translateY(-50%);
         font-size: 24px;
         color: #00bfa5;
         cursor: pointer;
      }

      .testimonial-navigation.left {
         left: 10px;
      }

      .testimonial-navigation.right {
         right: 10px;
         color: black;
      }

      .read-all-btn {
         display: block;
         margin: 30px auto 0;
         padding: 10px 20px;
         border: 2px solid #ff7f50;
         color: #ff7f50;
         text-align: center;
         text-decoration: none;
         font-size: 16px;
         border-radius: 5px;
      }

      .read-all-btn:hover {
         background-color: #ff7f50;
         color: #fff;
      }
   </style>
</head>

<body>
   <?php
   include("frontend/header.php");
   ?>
   <section class="hero-section">
      <div class="bg">
         <div class="content">
            <h1>Escape Your Comfort Zone.</h1>
            <p>Grab your stuff and let’s get lost.</p>
         </div>
         <div class="search-box">
            <form>
               <div class="mb-3 input-group">
                  <span class="input-group-text"><i class="fas fa-walking" id="search-icon"></i></span>
                  <select class="form-select" aria-label="Activity">
                     <option selected>Activity</option>
                     <option value="1">Activity 1</option>
                     <option value="2">Activity 2</option>
                     <option value="3">Activity 3</option>
                  </select>
               </div>
               <div class="mb-3 input-group">
                  <span class="input-group-text"><i class="fas fa-dollar-sign" id="search-icon"></i></span>
                  <select class="form-select" aria-label="Price">
                     <option selected>$0 - $0</option>
                     <option value="1">$0 - $50</option>
                     <option value="2">$50 - $100</option>
                     <option value="3">$100 - $200</option>
                  </select>
               </div>
               <div class="mb-3 input-group">
                  <span class="input-group-text"><i class="fas fa-map-marker-alt" id="search-icon"></i></span>
                  <select class="form-select" aria-label="Destination">
                     <option selected>Destination</option>
                     <option value="1">Destination 1</option>
                     <option value="2">Destination 2</option>
                     <option value="3">Destination 3</option>
                  </select>
               </div>
               <div class="mb-3 input-group">
                  <span class="input-group-text"><i class="fas fa-clock" id="search-icon"></i></span>
                  <select class="form-select" aria-label="Duration">
                     <option selected>0 Days - 11 Days</option>
                     <option value="1">1 Day - 3 Days</option>
                     <option value="2">4 Days - 7 Days</option>
                     <option value="3">8 Days - 11 Days</option>
                  </select>
               </div>
               <div class="mb-3 input-group">
                  <span class="input-group-text"><i class="fas fa-calendar-alt" id="search-icon"></i></span>
                  <select class="form-select" aria-label="Date">
                     <option selected>Date</option>
                     <option value="1">Date 1</option>
                     <option value="2">Date 2</option>
                     <option value="3">Date 3</option>
                  </select>
               </div>
               <button type="submit" class="btn btn-warning w-100">Search</button>
            </form>
         </div>
      </div>
   </section>
   <div class="features">
      <div class="container text-center py-5">
         <div class="row">
            <div class="col-md-4">
               <div class="feature-icon mx-auto">
                  <i class="fas fa-map-marker-alt fa-2x" style="color: #00bcd4;"></i>
               </div>
               <div class="feature-title">Handpicked Destination</div>
               <div class="feature-description">Our strict screening process means you're only seeing the best quality
                  treks.</div>
            </div>
            <div class="col-md-4">
               <div class="feature-icon mx-auto">
                  <i class="fas fa-tags fa-2x" style="color: #00bcd4;"></i>
               </div>
               <div class="feature-title">Best Price Guaranteed</div>
               <div class="feature-description">Our Best Price Guarantee means that you can be sure of booking at the
                  best rate.</div>
            </div>
            <div class="col-md-4">
               <div class="feature-icon mx-auto">
                  <i class="fas fa-headset fa-2x" style="color: #00bcd4;"></i>
               </div>
               <div class="feature-title">24/7 Customer Service</div>
               <div class="feature-description">Our customer are standing by 24/7 to make your experience incredible.
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="features">
      <div class="container text-center py-5">
         <h2 style="font-family: Dancing Script" , serif; color:green;">Popular Trips</h2>
         <h1>Explore popular trips</h1>
         <p>Get started with handpicked top rated trips.</p>
         <div class="divider"></div>
      </div>
   </div>

   <div class="features">
      <div class="container text-center py-5 card-container" id="card-container" style="row-gap:20px;">
         <?php for ($i = 0; $i < 4; $i++) { ?>
            <div class="card" style=" flex: 0 0 calc(33.33% - 20px);">
               <div class="position-relative">
                  <div class="carousel">
                     <div class="carousel-container">
                        <img src="assets/img/mustang.jpg" class="slide active">
                        <img src="assets/img/Manaslu.jpg" class="slide">
                        <img src="assets/img/nature.jpg" class="slide">
                     </div>
                     <button class="prev" onclick="prevSlide()">&#10094;</button>
                     <button class="next" onclick="nextSlide()">&#10095;</button>
                  </div>
                  <span class="badge-featured">
                     Featured
                  </span>
               </div>
               <div class="card-top">
                  <div class="card-body">
                     <div class="d-flex justify-content-between align-items-center" style="padding:10px 0px 10px 0px">
                        <h5 class="card-title mb-0">
                           Paris Effiel Tower Tour 1 Day Tour
                        </h5>
                        <i class="fas fa-heart wishlist-icon">
                        </i>
                     </div>
                     <div class="me-3 card-contents" style="padding:10px 0px 10px 0px; border-bottom:1px solid gray;">
                        <p class="mb-1">
                           Travel is the movement of people between relatively distant geographical...
                        </p>
                     </div>
                  </div>
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
                        <div class="price" style="margin-top:50%;">
                           <h2>$3000</h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php } ?>
      </div>
      <div class="features" style="margin-top:-50px;">
         <div class="container text-center py-5 card-container">
            <div class="container-custom" style="margin:0 auto;">
               <a href="#" class="btn btn-custom">VIEW ALL TRIPS</a>
            </div>
         </div>
      </div>
      <div class="features">
         <div class="container text-center py-5">
            <h2 style="font-family: Dancing Script" , serif;">Popular Destinations</h2>
            <h1>Explore popular destinations</h1>
            <p>A new journey begin here within, find a destination that suits you and start travelling. We offer best
               travel packages.</p>
            <div class="divider"></div>
         </div>
      </div>
      <div class="features" style="margin-top:-50px;">
         <div class="container text-center py-5 card-container">
            <div class="row g-4">
               <!-- Card 1 -->
               <div class="col-md-4">
                  <div class="trip-card">
                     <img src="assets/img/budget.jpg" alt="Nature Friendly Trip">
                     <div class="trip-card-body">
                        <h3 class="trip-card-title">Kathmandu</h3>
                        <p class="trip-card-text">Explore ancient temples, bustling markets, and affordable stays in
                           Nepal’s vibrant capital.</p>
                        <a href="#">Learn More</a>
                     </div>
                  </div>
               </div>
               <!-- Card 2 -->
               <div class="col-md-4">
                  <div class="trip-card">
                     <img src="assets/img/pokhara.jpg" alt="Cultural Trip">
                     <div class="trip-card-body">
                        <h3 class="trip-card-title">Pokhara</h3>
                        <p class="trip-card-text">Enjoy serene lakes, mountain views,and budget-friendly homestays in
                           this peaceful lakeside city.</p>
                        <a href="#">Learn More</a>
                     </div>
                  </div>
               </div>
               <!-- Card 3 -->
               <div class="col-md-4">
                  <div class="trip-card">
                     <img src="assets/img/lumbini.jpg" alt="Budget Travel">
                     <div class="trip-card-body">
                        <h3 class="trip-card-title">Lumbini</h3>
                        <p class="trip-card-text">Discover Buddha’s birthplace, serene monasteries, and budget stays in
                           Lumbini, Nepal. </p>
                        <a href="#">Learn More</a>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
      <div class="features" style="margin-top:-50px;">
         <div class="container text-center py-5 card-container">
            <div class="container-custom" style="margin:0 auto;">
               <a href="#" class="btn btn-custom">VIEW ALL DESTINATIONS</a>
            </div>
         </div>
      </div>

      <div class="features">
         <div class="container text-center py-5">
            <h2 style="font-family: Dancing Script" , serif;">Best Travels Deals</h2>
            <h1>Explore The Best Travel Deals</h1>
            <p>A new journey begin here within, find a destination that suits you and start travelling. We offer best
               travel packages.</p>
            <div class="divider"></div>
         </div>
      </div>
      <div class="features">
         <div class="container text-center py-5 card-container" id="card-container" style="row-gap:20px;">
            <?php for ($i = 0; $i < 3; $i++) { ?>
               <div class="card" style=" flex: 0 0 calc(33.33% - 20px);">
                  <div class="position-relative">
                     <div class="carousel">
                        <div class="carousel-container">
                           <img src="assets/img/mustang.jpg" class="slide active">
                           <img src="assets/img/Manaslu.jpg" class="slide">
                           <img src="assets/img/nature.jpg" class="slide">
                        </div>
                        <button class="prev" onclick="prevSlide()">&#10094;</button>
                        <button class="next" onclick="nextSlide()">&#10095;</button>
                     </div>
                     <span class="badge-featured">
                        Featured
                     </span>
                  </div>
                  <div class="card-top">
                     <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center" style="padding:10px 0px 10px 0px">
                           <h5 class="card-title mb-0">
                              Paris Effiel Tower Tour 1 Day Tour
                           </h5>
                           <i class="fas fa-heart wishlist-icon">
                           </i>
                        </div>
                        <div class="me-3 card-contents" style="padding:10px 0px 10px 0px; border-bottom:1px solid gray;">
                           <p class="mb-1">
                              Travel is the movement of people between relatively distant geographical...
                           </p>
                        </div>
                     </div>
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
                           <div class="price" style="margin-top:50%;">
                              <h2>$3000</h2>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <?php } ?>
         </div>
      </div>
      <div class="features">
         <div class="container text-center py-5">
            <h2 style="font-family: Dancing Script" , serif;"></h2>
            <h1>Client Testimonials</h1>
            <p></p>
            <div class="divider"></div>
         </div>
      </div>
      <div class="features">
         <div class="container text-center py-5">
            <div class="carousel-container">
               <div class="carousel">
                  <div class="testimonial">
                     <div class="testimonial-content">
                        <div class="testimonial-image">
                           <img alt="Portrait of a smiling woman with short blonde hair, wearing a striped shirt"
                              height="150" src="assets/img/client.jpeg" width="150" />
                        </div>
                        <div class="testimonial-text">
                           <h5>
                              <i class="fas fa-quote-left" style="color: green;">
                              </i>
                           </h5>
                           <h3>
                              Having fun with everyone
                           </h3>
                           <p>
                              message
                           </p>
                           <p class="author">
                              Madam Nozaia
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="testimonial">
                     <p>"Client 2: Highly recommended for all professionals."</p>
                     <h4>- Client 2</h4>
                  </div>
                  <div class="testimonial">
                     <p>"Client 3: The best experience I've had so far!"</p>
                     <h4>- Client 3</h4>
                  </div>
                  <div class="testimonial">
                     <p>"Client 4: Fast response and quality work!"</p>
                     <h4>- Client 4</h4>
                  </div>
                  <div class="testimonial">
                     <p>"Client 5: Very satisfied with the results!"</p>
                     <h4>- Client 5</h4>
                  </div>
               </div>

               <!-- Navigation Controls -->
               <button class="prev" style="color: black;">&#10094;</button>

               <button class="next" style="color: black;">&#10095;</button>
            </div>
         </div>
      </div>
      <script>
         const carousel = document.querySelector('.carousel');
         const testimonials = document.querySelectorAll('.testimonial');
         const nextBtn = document.querySelector('.next');
         const prevBtn = document.querySelector('.prev');

         let isSliding = false; // Prevent multiple clicks during transition

         // Move first slide to the end (loop effect)
         function nextSlide() {
            if (isSliding) return;
            isSliding = true;

            // Slide to the left
            carousel.style.transition = "transform 0.5s ease-in-out";
            carousel.style.transform = "translateX(-100%)";

            setTimeout(() => {
               // Move first item to the end
               const firstItem = carousel.firstElementChild;
               carousel.appendChild(firstItem);

               // Reset position instantly
               carousel.style.transition = "none";
               carousel.style.transform = "translateX(0)";

               isSliding = false;
            }, 500);
         }

         // Move last slide to the front (loop effect)
         function prevSlide() {
            if (isSliding) return;
            isSliding = true;

            // Move last item to the beginning before sliding
            const lastItem = carousel.lastElementChild;
            carousel.insertBefore(lastItem, carousel.firstElementChild);

            // Set instant position to the left
            carousel.style.transition = "none";
            carousel.style.transform = "translateX(-100%)";

            setTimeout(() => {
               // Slide back to the right
               carousel.style.transition = "transform 0.5s ease-in-out";
               carousel.style.transform = "translateX(0)";

               isSliding = false;
            }, 50);
         }

         // Auto-slide function
         function startAutoSlide() {
            return setInterval(nextSlide, 4000); // Slides every 4 seconds
         }

         let autoSlideInterval = startAutoSlide();

         // Event Listeners
         nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoSlide();
         });

         prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoSlide();
         });

         // Reset auto-slide timer on user interaction
         function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = startAutoSlide();
         }
      </script>
      <script>
         document.querySelectorAll(".card").forEach(card => {
            let currentIndex = 0; // Index for each card
            const slides = card.querySelectorAll(".slide");

            function showSlide(index) {
               slides.forEach(slide => slide.classList.remove("active"));
               slides[index].classList.add("active");
            }

            function nextSlide() {
               currentIndex = (currentIndex + 1) % slides.length;
               showSlide(currentIndex);
            }

            function prevSlide() {
               currentIndex = (currentIndex - 1 + slides.length) % slides.length;
               showSlide(currentIndex);
            }

            // Attach event listeners to next & prev buttons inside the card
            card.querySelector(".next").addEventListener("click", nextSlide);
            card.querySelector(".prev").addEventListener("click", prevSlide);
         });

      </script>
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