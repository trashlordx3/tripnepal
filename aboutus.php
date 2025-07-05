<?php
include("frontend/session_start.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/index.css">

  <style>
    /* Minimal CSS only for hero background and overlay */
    .hero-aboutus-hero {
      background: url('assets/img/faqs.jpg') no-repeat center center/cover;
      color: white;
      text-align: center;
      padding: 6rem 1rem;
      position: relative;
    }
    .hero-aboutus-hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }
    .hero-aboutus-hero > * {
      position: relative;
      z-index: 1;
    }
  </style>
</head>

<body>

  <?php include("frontend/header.php"); ?>

  <!-- Hero Section -->
  <header class="hero-aboutus-hero d-flex flex-column justify-content-center align-items-center">
    <div class="container">
      <h1 class="display-4 fw-bold">Welcome</h1>
      <p class="lead">Your trusted partner for unforgettable journeys around the globe.</p>
    </div>
  </header>

  <!-- About Us Section -->
  <section class="container my-5">
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="assets/img/Historical-Places-in-Nepal.jpg" alt="About Us" class="img-fluid rounded shadow" />
      </div>
      <div class="col-md-6">
        <h2>About Us</h2>
        <p>At ThankyouNepalTrip, we are passionate about crafting extraordinary travel experiences. Whether you're seeking a peaceful retreat, a thrilling adventure, or a deep dive into cultural wonders, we are here to make it happen.</p>
        <p>Our team of travel experts ensures every journey is tailored to your preferences, offering personalized itineraries, insider tips, and unparalleled service.</p>
        <p>We believe that travel is not just about visiting new places; it's about creating memories that last a lifetime. Join us to explore Nepal like never before!</p>
      </div>
    </div>
  </section>

  <!-- Our Values Section -->
  <section class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-5">Our Values</h2>
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <i class="fas fa-globe fa-2x text-primary mb-3"></i>
          <h5>Nepal Base</h5>
          <p>We offer destinations across different cities and districts of Nepal, ensuring a travel experience for everyone.</p>
        </div>
        <div class="col-md-4 mb-4">
          <i class="fas fa-heart fa-2x text-primary mb-3"></i>
          <h5>Customer Focus</h5>
          <p>Our travelers are at the heart of everything we do. Your satisfaction is our priority.</p>
        </div>
        <div class="col-md-4 mb-4">
          <i class="fas fa-umbrella-beach fa-2x text-primary mb-3"></i>
          <h5>Unmatched Experiences</h5>
          <p>From exotic escapes to local adventures, we curate experiences that are truly unique.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="py-5 text-white text-center" style="background-color: #008080;">
    <div class="container">
      <h3 class="mb-3">Ready to start your journey?</h3>
      <p>Contact us today to plan your dream vacation!</p>
      <a href="contactus.php" class="btn btn-light btn-lg mt-3">Get in Touch</a>
    </div>
  </section>

  <?php
  include("frontend/footer.php");
  include("frontend/scrollup.html");
  ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
