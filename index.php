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