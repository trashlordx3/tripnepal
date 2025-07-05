<?php
session_start();
require 'connection.php';

// Fetch all activities from the database
$sql = "SELECT activity_id, activity, description, act_image, activity_status FROM activity";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Activities</title>

  <!-- Fonts & Bootstrap -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/index.css">

  <!-- Custom Styles -->
  <style>
    .hero {
      position: relative;
      background: url('assets/img/rafting.jpg') no-repeat center center/cover;
      color: white;
      text-align: center;
      padding: 80px 20px;
      z-index: 1;
      overflow: hidden;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: bold;
    }

    .hero p {
      font-size: 1.5rem;
    }

    .activities-card {
      background-color: #fff;
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .activities-card:hover {
      transform: translateY(-10px);
    }

    .activities-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .activities-card-body {
      padding: 20px;
    }

    .activities-card-title {
      font-size: 1.5rem;
      color: #17252a;
      margin-bottom: 10px;
    }

    .activities-card-text {
      color: #555;
      font-size: 1rem;
      margin-bottom: 15px;
    }

    .activities-card a {
      color: #3aafa9;
      text-decoration: none;
      font-weight: bold;
    }

    .activities-card a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body style="background-color: #f8f9fa;">
  <?php include("frontend/header.php"); ?>

  <!-- Hero Section -->
  <div class="hero">
    <h1>Explore Popular Activities</h1>
    <p>Discover your perfect destination and dive into unforgettable experiences.</p>
  </div>

  <!-- Activity Cards Section -->
  <div class="container py-5">
    <div class="row g-4">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($activities = $result->fetch_assoc()): ?>
          <div class="col-md-4">
            <div class="activities-card h-100">
              <a href="view-activities.php?activity_id=<?php echo $activities['activity_id']; ?>">

                <?php
                  $imagePath = htmlspecialchars($activities['act_image']);
                  
                  // If only filename is stored (e.g., rafting.jpg), prepend path
                  if (!str_contains($imagePath, '/') && !empty($imagePath)) {
                      $imagePath = "assets/img/" . $imagePath;
                  }
                ?>

                <?php if (!empty($activities['act_image'])): ?>
                  <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($activities['activity']); ?>"
                       onerror="this.onerror=null;this.src='assets/img/no-image.jpg';">
                <?php else: ?>
                  <div class="d-flex justify-content-center align-items-center bg-light text-muted" style="height: 200px;">
                    No image available
                  </div>
                <?php endif; ?>
              </a>

              <div class="activities-card-body">
                <h5 class="activities-card-title">
                  <a href="view-activities.php?activity_id=<?php echo $activities['activity_id']; ?>">
                    <?php echo htmlspecialchars($activities["activity"]); ?>
                  </a>
                </h5>
                <p class="activities-card-text">
                  <?php
                    $description = $activities['description'];
                    $words = explode(" ", $description);
                    $firstTwentyWords = implode(" ", array_slice($words, 0, 20));
                    echo htmlspecialchars($firstTwentyWords) . '...';
                  ?>
                </p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted py-4">No activity types found.</div>
      <?php endif; ?>
    </div>
  </div>

  <?php include("frontend/footer.php"); ?>
  <?php include("frontend/scrollup.html"); ?>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
