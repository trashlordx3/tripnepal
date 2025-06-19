<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>NepalTrip</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
   <link rel="stylesheet" href="assets/css/index.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="bg-gray-100">
   <?php include("frontend/header.php"); ?>
   <section class="hero-section mt-1" style="background-image: url('assets/img/nepal.png'); background-size: cover; background-position: center; background-repeat: no-repeat;">
      <div class="bg bg-opacity-70" style="background: rgba(0,0,0,0.4); min-height: 450px;">
         <div class="content text-center text-white py-12">
            <h1 class="text-4xl font-bold">Escape Your Comfort Zone.</h1>
            <p class="text-lg"> Grab your stuff and let’s get lost.</p>
         </div>
         <div class="search-box max-w-lg mx-auto bg-white bg-opacity-90 rounded-lg p-6 shadow-lg">
            <form>
               <div class="mb-3">
                  <div class="input-group">
                     <span class="input-group-text"><i class="fas fa-walking" id="search-icon"></i></span>
                     <select class="form-select" aria-label="Activity">
                        <option selected>Activity</option>
                        <option value="1">Activity 1</option>
                        <option value="2">Activity 2</option>
                        <option value="3">Activity 3</option>
                     </select>
                  </div>
               </div>
               <div class="mb-3">
                  <div class="input-group">
                     <span class="input-group-text"><i class="fas fa-dollar-sign" id="search-icon"></i></span>
                     <select class="form-select" aria-label="Price">
                        <option selected>$0 - $0</option>
                        <option value="1">$0 - $50</option>
                        <option value="2">$50 - $100</option>
                        <option value="3">$100 - $200</option>
                     </select>
                  </div>
               </div>
               <div class="mb-3">
                  <div class="input-group">
                     <span class="input-group-text"><i class="fas fa-map-marker-alt" id="search-icon"></i></span>
                     <select class="form-select" aria-label="Destination">
                        <option selected>Destination</option>
                        <option value="1">Destination 1</option>
                        <option value="2">Destination 2</option>
                        <option value="3">Destination 3</option>
                     </select>
                  </div>
               </div>
               <div class="mb-3">
                  <div class="input-group">
                     <span class="input-group-text"><i class="fas fa-clock" id="search-icon"></i></span>
                     <select class="form-select" aria-label="Duration">
                        <option selected>0 Days - 11 Days</option>
                        <option value="1">1 Day - 3 Days</option>
                        <option value="2">4 Days - 7 Days</option>
                        <option value="3">8 Days - 11 Days</option>
                     </select>
                  </div>
               </div>
               <div class="mb-3">
                  <div class="input-group">
                     <span class="input-group-text"><i class="fas fa-calendar-alt" id="search-icon"></i></span>
                     <select class="form-select" aria-label="Date">
                        <option selected>Date</option>
                        <option value="1">Date 1</option>
                        <option value="2">Date 2</option>
                        <option value="3">Date 3</option>
                     </select>
                  </div>
               </div>
               <button type="submit" class="btn btn-warning w-full bg-yellow-500 text-white">Search</button>
            </form>
         </div>
      </div>
   </section>


   <!-- TripTypes -->
   <div class="features">
      <div class="container text-center py-5">
         <h1 class="text-3xl font-bold">Explore popular trips</h1>
         <p class="text-gray-600">Get started with handpicked top rated trips.</p>
      </div>
      <?php
      include_once("admin/frontend/connection.php");
      $trip_result = $conn->query("SELECT * FROM triptypes LIMIT 3");
      ?>
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4">
         <?php if ($trip_result && $trip_result->num_rows > 0) {
            while ($trip = $trip_result->fetch_assoc()) { ?>
               <div class="card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                  <div class="relative">
                     <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>">
                        <img src="<?php echo htmlspecialchars($trip['main_image']); ?>" class="h-64 w-full object-cover rounded-t-lg" alt="<?php echo htmlspecialchars($trip['triptype']); ?>">
                     </a>
                     <span class="absolute top-2 left-2 bg-yellow-400 text-white text-xs font-bold px-2 py-1 rounded">Featured</span>
                  </div>
                  <div class="p-4">
                     <h5 class="text-lg font-semibold mb-2">
                        <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>" class="text-black hover:text-teal-600"><?php echo htmlspecialchars($trip["triptype"]); ?></a>
                     </h5>
                     <p class="text-gray-600 mb-2">
                        <?php
                        $description = $trip['description'];
                        $words = explode(" ", $description);
                        $firstTenWords = implode(" ", array_slice($words, 0, 10));
                        echo htmlspecialchars($firstTenWords) . '...';
                        ?>
                     </p>
                     <!-- You can add more trip details here if needed -->
                  </div>
               </div>
            <?php }
         } ?>
      </div>
      <div class="features">
         <div class="container mx-auto text-center py-5">
         <a href="triptypes.php" class="btn btn-custom border border-orange-500 text-orange-500 bg-transparent px-4 py-2 rounded hover:bg-orange-500 hover:text-white">VIEW ALL TRIPS</a>
         </a>
      </div>
   </div>



   <!-- Destiantion -->
   <div class="features">
      <div class="container text-center py-5">
         <h1 class="text-3xl font-bold">Explore popular destinations</h1>
         <p class="text-gray-600">A new journey begins here within, find a destination that suits you and start travelling. We offer best travel packages.</p>

      </div>
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4">
         <div class="trip-card bg-white rounded-lg shadow-md overflow-hidden">
            <img src="assets/img/budget.jpg" alt="Nature Friendly Trip" class="w-full h-48 object-cover">
            <div class="p-4">
               <h3 class="text-xl font-semibold">Kathmandu</h3>
               <p class="text-gray-600">Explore ancient temples, bustling markets, and affordable stays in Nepal’s vibrant capital.</p>
               <a href="#" class="text-teal-600 font-bold">Learn More</a>
            </div>
         </div>
         <div class="trip-card bg-white rounded-lg shadow-md overflow-hidden">
            <img src="assets/img/pokhara.jpg" alt="Cultural Trip" class="w-full h-48 object-cover">
            <div class="p-4">
               <h3 class="text-xl font-semibold">Pokhara</h3>
               <p class="text-gray-600">Enjoy serene lakes, mountain views, and budget-friendly homestays in this peaceful lakeside city.</p>
               <a href="#" class="text-teal-600 font-bold">Learn More</a>
            </div>
         </div>
         <div class="trip-card bg-white rounded-lg shadow-md overflow-hidden">
            <img src="assets/img/lumbini.jpg" alt="Budget Travel" class="w-full h-48 object-cover">
            <div class="p-4">
               <h3 class="text-xl font-semibold">Lumbini</h3>
               <p class="text-gray-600">Discover Buddha’s birthplace, serene monasteries, and budget stays in Lumbini, Nepal.</p>
               <a href="#" class="text-teal-600 font-bold">Learn More</a>
            </div>
         </div>
      </div>
      <div class="features">
         <div class="container text-center py-5">
            <a href="destination" class="btn btn-custom border border-orange-500 text-orange-500 bg-transparent px-4 py-2 rounded hover:bg-orange-500 hover:text-white">VIEW ALL DESTINATIONS</a>
         </div>
      </div>
   </div>

   <!-- Client Reviews -->

   <div class="features">
      <div class="container text-center py-5">
         <h1 class="text-3xl font-bold">Explore The Best Travel Deals</h1>
         <p class="text-gray-600">A new journey begins here within, find a destination that suits you and start travelling. We offer best travel packages.</p>
         <div class="divider my-4 mx-auto w-12 h-1 bg-orange-500"></div>
      </div>
   </div>

   <div class="features">
      <div class="container text-center py-5">
         <h1 class="text-3xl font-bold">Client Reviews</h1>
         <p class="text-gray-600">Get started with Reviews</p>
         <div class="divider my-4 mx-auto w-12 h-1 bg-orange-500"></div>
      </div>
   </div>

   <div class="features">
      <div class="container mx-auto">
         <div class="carousel-testi">
            <div class="reviews flex overflow-hidden" id="reviews">
               <div class="review flex-none w-full">
                  <div class="container-testi flex items-center gap-4 p-4 bg-white rounded-lg shadow-md">
                     <div class="image-container">
                        <img src="assets/img/client.jpeg" alt="A young woman with a backpack and headphones, ready for travel" class="rounded-full w-32 h-32 object-cover">
                     </div>
                     <div class="text-container">
                        <div class="quote-icon text-teal-600 text-3xl">“</div>
                        <h2 class="title text-xl font-bold">Get Ahead in Travel with Booking</h2>
                        <p class="description text-gray-600">Inquietude simplicity terminated she compliment remarkably few her nay. The weeks are ham asked jokes. Neglected perceived shy nay concluded.</p>
                        <p class="author text-gray-800 font-medium">Selvetica Forez</p>
                     </div>
                  </div>
               </div>
               <!-- Repeat review structure for additional reviews -->
            </div>
            <div class="buttons mt-4">
               <button onclick="prevReview()" class="bg-green-600 text-white px-4 py-2 rounded">Prev</button>
               <button onclick="nextReview()" class="bg-green-600 text-white px-4 py-2 rounded">Next</button>
            </div>
         </div>
      </div>
   </div>

   <?php include("frontend/footer.php"); ?>

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
