<?php
include("frontend/session_start.php");
include("connection.php");

$stmt = $conn->prepare("SELECT trips.*, trip_images.main_image
FROM trips 
INNER JOIN trip_images ON trips.tripid = trip_images.tripid");
$stmt->execute();
$trip_result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>NepalTrip</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
   <link rel="stylesheet" href="assets/css/index.css" />
   <style>
      /* Hero Section with overlay */
      .hero-section {
         position: relative;
         background-image: url('assets/img/nepal.png');
         background-size: cover;
         background-position: center;
         background-repeat: no-repeat;
         min-height: 450px;
         color: white;
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding: 0 3rem;
      }

      .hero-section::before {
         content: "";
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.4);
         z-index: 0;
      }

      .hero-content {
         position: relative;
         z-index: 1;
         max-width: 50%;
      }

      .search-box {
         position: relative;
         z-index: 1;
         max-width: 400px;
         background-color: rgba(255, 255, 255, 0.9);
         border-radius: 0.5rem;
         padding: 1.5rem;
         box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      }
      .card-img-top {
         width: 100%;         /* full width of the card */
         height: 250px;       /* fixed height for uniformity */
         object-fit: cover;   /* scale image to cover area, cropping if needed */
         object-position: center; /* center the image */
      }


      /* Responsive adjustments */
      @media (max-width: 991.98px) {
         .hero-section {
            flex-direction: column;
            padding: 2rem;
            min-height: auto;
         }
         .hero-content, .search-box {
            max-width: 100%;
            width: 100%;
            margin-bottom: 2rem;
         }
         .search-box {
            margin-bottom: 0;
         }
      }
   </style>
</head>

<body class="bg-light">
   <?php include("frontend/header.php"); ?>

   <!-- Hero Section -->
   <section class="hero-section">
      <div class="hero-content">
         <h1 class="display-4 fw-bold">Escape Your Comfort Zone.</h1>
         <p class="lead">Grab your stuff and let’s get lost.</p>
      </div>

      <div class="search-box">
         <form>
            <div class="mb-3">
               <label class="form-label visually-hidden" for="activitySelect">Activity</label>
               <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-walking"></i></span>
                  <select class="form-select" id="activitySelect" aria-label="Activity">
                     <option selected>Activity</option>
                     <option value="1">Activity 1</option>
                     <option value="2">Activity 2</option>
                     <option value="3">Activity 3</option>
                  </select>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label visually-hidden" for="priceSelect">Price</label>
               <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  <select class="form-select" id="priceSelect" aria-label="Price">
                     <option selected>$0 - $0</option>
                     <option value="1">$0 - $50</option>
                     <option value="2">$50 - $100</option>
                     <option value="3">$100 - $200</option>
                  </select>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label visually-hidden" for="destinationSelect">Destination</label>
               <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                  <select class="form-select" id="destinationSelect" aria-label="Destination">
                     <option selected>Destination</option>
                     <option value="1">Destination 1</option>
                     <option value="2">Destination 2</option>
                     <option value="3">Destination 3</option>
                  </select>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label visually-hidden" for="durationSelect">Duration</label>
               <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-clock"></i></span>
                  <select class="form-select" id="durationSelect" aria-label="Duration">
                     <option selected>0 Days - 11 Days</option>
                     <option value="1">1 Day - 3 Days</option>
                     <option value="2">4 Days - 7 Days</option>
                     <option value="3">8 Days - 11 Days</option>
                  </select>
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label visually-hidden" for="dateSelect">Date</label>
               <div class="input-group">
                  <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  <select class="form-select" id="dateSelect" aria-label="Date">
                     <option selected>Date</option>
                     <option value="1">Date 1</option>
                     <option value="2">Date 2</option>
                     <option value="3">Date 3</option>
                  </select>
               </div>
            </div>

            <button type="submit" class="btn btn-warning w-100">Search</button>
         </form>
      </div>
   </section>

   <!-- Destination -->
   <section class="features py-5 bg-white">
      <div class="container text-center mb-4">
         <h2 class="fw-bold">Explore popular destinations</h2>
         <p class="text-secondary">A new journey begins here within, find a destination that suits you and start travelling. We offer best travel packages.</p>
      </div>

      <?php
      $result = $conn->query("SELECT * FROM destination WHERE status = 'active' LIMIT 3");
      ?>

      <div class="container">
         <div class="row g-4">
            <?php if ($result && $result->num_rows > 0): ?>
               <?php while ($row = $result->fetch_assoc()): ?>
                  <div class="col-md-4">
                     <div class="card shadow-sm h-100">
                        <div class="position-relative">
                           <a href="view-destination.php?destination_id=<?php echo $row['destination_id']; ?>">
                              <?php if (!empty($row['dest_image'])): ?>
                                 <img src="<?php echo htmlspecialchars($row['dest_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['destination']); ?>">
                              <?php else: ?>
                                 <div class="d-flex justify-content-center align-items-center bg-secondary text-white" style="height: 250px;">
                                    No Image
                                 </div>
                              <?php endif; ?>
                           </a>
                           <span class="position-absolute top-0 start-0 bg-warning text-white small fw-bold px-2 py-1 rounded-end">Featured</span>
                        </div>
                        <div class="card-body">
                           <h5 class="card-title">
                           <a href="view-destination.php?destination_id=<?php echo $row['destination_id']; ?>" style="color: #008080; text-decoration: none; font-weight: bold;">

                                 <?php echo htmlspecialchars($row['destination']); ?>
                              </a>
                           </h5>
                           <p class="card-text text-secondary">
                              <?php
                              $desc = $row['description'];
                              $descWords = explode(" ", $desc);
                              $shortDesc = implode(" ", array_slice($descWords, 0, 20));
                              echo htmlspecialchars($shortDesc) . '...';
                              ?>
                           </p>
                        </div>
                     </div>
                  </div>
               <?php endwhile; ?>
            <?php else: ?>
               <div class="col-12 text-center text-muted">No destinations found.</div>
            <?php endif; ?>
         </div>

         <div class="text-center mt-4">
            <a href="destination" class="btn btn-outline-warning rounded-pill px-4 py-2 fw-semibold">
               VIEW ALL DESTINATIONS
            </a>
         </div>
      </div>
   </section>

   <!-- Activities -->
   <section class="features py-5">
      <div class="container text-center mb-4">
         <h2 class="fw-bold">Explore popular Activities</h2>
         <p class="text-secondary">Discover your perfect destination and dive into unforgettable experiences.</p>
      </div>

      <?php
      $result = $conn->query("SELECT activity_id, activity, description, act_image FROM activity WHERE activity_status = 'active' LIMIT 3");
      ?>

      <div class="container">
         <div class="row g-4">
            <?php if ($result && $result->num_rows > 0): ?>
               <?php while ($row = $result->fetch_assoc()): ?>
                  <div class="col-md-4">
                     <div class="card shadow-sm h-100">
                        <div class="position-relative">
                           <a href="view-activity.php?activity_id=<?php echo $row['activity_id']; ?>">
                              <?php if (!empty($row['act_image'])): ?>
                                 <img src="<?php echo htmlspecialchars($row['act_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['activity']); ?>">
                              <?php else: ?>
                                 <div class="d-flex justify-content-center align-items-center bg-secondary text-white" style="height: 250px;">
                                    No Image
                                 </div>
                              <?php endif; ?>
                           </a>
                           <span class="position-absolute top-0 start-0 bg-warning text-white small fw-bold px-2 py-1 rounded-end">Featured</span>
                        </div>
                        <div class="card-body">
                           <h5 class="card-title">
                              <a href="view-activity.php?activity_id=<?php echo $row['activity_id']; ?>" style="color: #008080; text-decoration: none; font-weight: bold;">
                                 <?php echo htmlspecialchars($row['activity']); ?>
                              </a>
                           </h5>
                           <p class="card-text text-secondary">
                              <?php
                              $desc = $row['description'];
                              $descWords = explode(" ", $desc);
                              $shortDesc = implode(" ", array_slice($descWords, 0, 20));
                              echo htmlspecialchars($shortDesc) . '...';
                              ?>
                           </p>
                        </div>
                     </div>
                  </div>
               <?php endwhile; ?>
            <?php else: ?>
               <div class="col-12 text-center text-muted">No activities found.</div>
            <?php endif; ?>
         </div>

         <div class="text-center mt-4">
            <a href="more-activity" class="btn btn-outline-warning rounded-pill px-4 py-2 fw-semibold">
               VIEW ALL ACTIVITIES
            </a>
         </div>
      </div>
   </section>

   <!-- Trip Types -->
   <section class="features py-5">
      <div class="container text-center mb-4">
         <h2 class="fw-bold">Explore popular trips</h2>
         <p class="text-secondary">Get started with handpicked top rated trips.</p>
      </div>

      <?php
      include_once("admin/frontend/connection.php");
      $trip_result = $conn->query("SELECT * FROM triptypes LIMIT 3");
      ?>

      <div class="container">
         <div class="row g-4">
            <?php if ($trip_result && $trip_result->num_rows > 0) {
               while ($trip = $trip_result->fetch_assoc()) { ?>
                  <div class="col-md-4">
                     <div class="card shadow-sm h-100">
                        <div class="position-relative">
                           <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>">
                              <img src="<?php echo htmlspecialchars($trip['main_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($trip['triptype']); ?>">
                           </a>
                           <span class="position-absolute top-0 start-0 bg-warning text-white small fw-bold px-2 py-1 rounded-end">Featured</span>
                        </div>
                        <div class="card-body">
                           <h5 class="card-title">
                              <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>" style="color: #008080; text-decoration: none; font-weight: bold;">
                                 <?php echo htmlspecialchars($trip["triptype"]); ?>
                              </a>
                           </h5>
                           <p class="card-text text-secondary">
                              <?php
                              $description = $trip['description'];
                              $words = explode(" ", $description);
                              $firstWords = implode(" ", array_slice($words, 0, 20));
                              echo htmlspecialchars($firstWords) . '...';
                              ?>
                           </p>
                        </div>
                     </div>
                  </div>
            <?php }
            } ?>
         </div>

         <div class="text-center mt-4">
            <a href="typetrip" class="btn btn-outline-warning rounded-pill px-4 py-2 fw-semibold">
               VIEW ALL Trips
            </a>
         </div>
      </div>
   </section>



   <!-- Client Reviews (Static Example) -->
   <section class="features py-5 bg-white">
      <div class="container text-center mb-4">
         <h2 class="fw-bold">Explore The Best Travel Deals</h2>
         <p class="text-secondary">A new journey begins here within, find a destination that suits you and start travelling. We offer best travel packages.</p>
         <hr class="mx-auto" style="width: 3rem; border-top: 3px solid #f59e0b; margin-bottom: 2rem;" />
      </div>

      <div class="container text-center mb-4">
         <h2 class="fw-bold">Client Reviews</h2>
         <p class="text-secondary">Get started with Reviews</p>
         <hr class="mx-auto" style="width: 3rem; border-top: 3px solid #f59e0b; margin-bottom: 2rem;" />
      </div>

      <div class="container">
         <div id="carouselReviews" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="d-flex flex-column flex-md-row align-items-center bg-white rounded shadow p-4">
                     <img src="assets/img/client.jpeg" class="rounded-circle me-md-4 mb-3 mb-md-0" alt="Client" style="width: 120px; height: 120px; object-fit: cover;">
                     <div>
                        <blockquote class="blockquote">
                           <p class="mb-3">“Inquietude simplicity terminated she compliment remarkably few her nay. The weeks are ham asked jokes. Neglected perceived shy nay concluded.”</p>
                        </blockquote>
                        <footer class="blockquote-footer">Selvetica Forez</footer>
                        <h5 class="mt-2">Get Ahead in Travel with Booking</h5>
                     </div>
                  </div>
               </div>
               <!-- Add more carousel-items here for other reviews -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselReviews" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselReviews" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="visually-hidden">Next</span>
            </button>
         </div>
      </div>
   </section>

   <?php include("frontend/footer.php"); ?>

   <div class="scroll-up position-fixed bottom-0 end-0 m-4 d-none" id="scrollUpButton" style="z-index: 1050; cursor:pointer;">
      <i class="fas fa-chevron-up fa-2x"></i>
   </div>

   <script>
      window.onscroll = function () {
         var scrollUpButton = document.getElementById("scrollUpButton");
         if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollUpButton.classList.remove("d-none");
            scrollUpButton.classList.add("d-flex");
         } else {
            scrollUpButton.classList.add("d-none");
            scrollUpButton.classList.remove("d-flex");
         }
      };

      function scrollToTop() {
         window.scrollTo({
            top: 0,
            behavior: 'smooth'
         });
      }

      document.getElementById("scrollUpButton").addEventListener("click", scrollToTop);
   </script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
