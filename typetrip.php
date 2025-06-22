<?php
require 'connection.php';

// Fetch all triptypes with main_image from the database
$sql = "SELECT triptype_id, triptype, description, main_image FROM triptypes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Trip Types</title>

  <!-- Fonts & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/index.css">

  <!-- Custom Styles for Trip Types -->
  <style>
    .hero {
      background: url('assets/img/Manaslu.jpg') no-repeat center center/cover;
      color: white;
      text-align: center;
      padding: 80px 20px;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.5rem;
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
  </style>
</head>

<body style="background-color: #f8f9fa;">
  <?php include("frontend/header.php"); ?>

  <!-- Hero Section -->
  <div class="hero">
    <h1>Explore popular trips</h1>
    <p>Get started with handpicked top rated trips.</p>
  </div>

  <!-- Trip Cards Section -->
  <div class="container py-5">
    <div class="row g-4">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($trip = $result->fetch_assoc()): ?>
          <div class="col-md-4">
            <div class="trip-card h-100">
              <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>">
                <?php if (!empty($trip['main_image'])): ?>
                  <img src="<?php echo htmlspecialchars($trip['main_image']); ?>" alt="<?php echo htmlspecialchars($trip['triptype']); ?>">
                <?php else: ?>
                  <div class="d-flex justify-content-center align-items-center bg-light text-muted" style="height: 200px;">
                    No image
                  </div>
                <?php endif; ?>
              </a>
              <div class="trip-card-body">
                <h5 class="trip-card-title">
                  <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>">
                    <?php echo htmlspecialchars($trip["triptype"]); ?>
                  </a>
                </h5>
                <p class="trip-card-text">
                  <?php
                    $description = $trip['description'];
                    $words = explode(" ", $description);
                    $firstTenWords = implode(" ", array_slice($words, 0, 20));
                    echo htmlspecialchars($firstTenWords) . '...';
                  ?>
                </p>
                <?php if (isset($trip['trip_status'])): ?>
                  <span class="badge bg-<?php echo $trip['trip_status'] === 'active' ? 'success' : 'secondary'; ?>">
                    <?php echo htmlspecialchars(ucfirst($trip['trip_status'])); ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted py-4">No trip types found.</div>
      <?php endif; ?>
    </div>
  </div>

  <?php include("frontend/footer.php"); 
  include("frontend/scrollup.html");?>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
