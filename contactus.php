<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us</title>
  
  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/index.css">
  
  <style>
    .hero {
      background: url('assets/img/pk.jpg') no-repeat center center/cover;
      color: white;
      text-align: center;
      padding: 5rem 1rem;
    }

    /* Location map container */
    .location-map iframe {
      width: 100%;
      height: 600px; /* Increased height */
      border: none;
      border-radius: 8px;
    }
  </style>
</head>

<body>

  <?php include("frontend/header.php"); ?>

  <!-- Hero Section -->
  <header class="hero d-flex align-items-center justify-content-center">
    <h1 class="display-4 fw-bold">Contact Us</h1>
  </header>

  <!-- Contact Section -->
  <div class="container-fluid bg-light py-5">
    <div class="container">
      <div class="row g-4">
        <!-- Form Section -->
        <div class="col-lg-7">
          <div class="card shadow-sm rounded-3 p-4">
            <h3 class="mb-4">Get in touch</h3>
            <form action="https://api.web3forms.com/submit" method="POST" novalidate>
              <input type="hidden" name="access_key" value="8789583e-fd9e-44e5-a6e8-e265ceec0848">
              <div class="mb-3">
                <label for="name" class="form-label">Full Name*</label>
                <input type="text" class="form-control" id="name" name="full-name" placeholder="Full name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
              </div>
              <div class="mb-3">
                <label for="subject" class="form-label">Subject*</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Write subject" required>
              </div>
              <div class="mb-3">
                <label for="message" class="form-label">Message*</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message" required></textarea>
              </div>
              <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="policy" required>
                <label class="form-check-label" for="policy">
                  By contacting us, you agree to our <a href="#" class="text-decoration-none">Privacy Policy</a>.
                </label>
              </div>
              <button type="submit" class="btn btn-warning w-100">SEND MESSAGE</button>
            </form>
          </div>
        </div>

        <!-- Contact Information Section -->
        <div class="col-lg-5">
          <div class="card shadow-sm rounded-3 p-4 bg-teal text-white">
            <h4>Contact Information</h4>
            <p class="mb-1">Kathmandu<br>Bagmati, Nepal</p>
            <p class="mb-1">
              <i class="fas fa-phone me-2"></i>(+977) 123-456789<br>
              <i class="fas fa-phone me-2"></i>(+977) 123-856475
            </p>
            <p>
              <i class="fas fa-envelope me-2"></i>thankyounepaltrip.com<br>
              <i class="fas fa-envelope me-2"></i>thankyounepaltrip@gmail.com
            </p>
            <h5 class="mt-4">Follow us on</h5>
            <div>
              <a href="#" class="text-white me-3 fs-4"><i class="fab fa-facebook"></i></a>
              <a href="#" class="text-white me-3 fs-4"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-white me-3 fs-4"><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Enlarged Location Section -->
  <div class="container my-5">
    <div class="p-4 shadow rounded location-map">
      <?php include("frontend/location.php"); ?>
    </div>
  </div>

  <?php
  include("frontend/footer.php");
  include("frontend/scrollup.html");
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
