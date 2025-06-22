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
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body style="background-color: #f8f9fa;">
  <div>
      <?php include("frontend/header.php"); ?>
  </div>

  <!-- Hero Section -->
  <div class="position-relative bg-dark text-white d-flex align-items-center justify-content-center" style="height: 300px; background-image: url('assets/img/nature.jpg'); background-size: cover; background-position: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
    <h1 class="position-relative z-1 display-4 fw-bold text-shadow">Trip Types</h1>
  </div>

  <!-- Trip Cards Section -->
  <div class="container py-5">
    <div class="row g-4">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($trip = $result->fetch_assoc()): ?>
          <div class="col-md-4">
            <div class="card h-100 shadow-sm">
              <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>">
                <?php if (!empty($trip['main_image'])): ?>
                  <img src="<?php echo htmlspecialchars($trip['main_image']); ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?php echo htmlspecialchars($trip['triptype']); ?>">
                <?php else: ?>
                  <div class="d-flex justify-content-center align-items-center bg-light text-muted" style="height: 250px;">
                    No image
                  </div>
                <?php endif; ?>
              </a>
              <div class="card-body">
                <h5 class="card-title">
                  <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>" class="text-decoration-none text-dark">
                    <?php echo htmlspecialchars($trip["triptype"]); ?>
                  </a>
                </h5>
                <p class="card-text text-muted">
                  <?php
                    $description = $trip['description'];
                    $words = explode(" ", $description);
                    $firstTenWords = implode(" ", array_slice($words, 0, 10));
                    echo htmlspecialchars($firstTenWords) . '...';
                  ?>
                </p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted py-4">No trip types found.</div>
      <?php endif; ?>
    </div>
  </div>
<?php include("frontend/footer.php"); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
