<?php
session_start();
require 'connection.php';
// Fetch all destinations from the database
$destSql = "SELECT destination_id, destination, description, dest_image, status FROM destination";
$destResult = $conn->query($destSql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/index.css">
    <style>
        .hero {
        position: relative;
        background: url('assets/img/chitwan.jpg') no-repeat center center/cover;
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
        background-color: rgba(0, 0, 0, 0.5); /* 50% black mask */
        z-index: -1;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: bold;
    }

    .hero p {
        font-size: 1.5rem;
    }
        .destination-types {
            padding: 60px 15px;
            text-align: center;
        }

        .destination-types h1 {
            font-size: 2.5rem;
            color: #17252a;
            margin-bottom: 20px;
        }

        .destination-types p {
            color: #3aafa9;
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        .destination-card {
            background-color: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .destination-card:hover {
            transform: translateY(-10px);
        }

        .destination-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .destination-card-body {
            padding: 20px;
        }

        .destination-card-title {
            font-size: 1.5rem;
            color: #17252a;
            margin-bottom: 10px;
        }

        .destination-card-text {
            color: #555;
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .destination-card a {
            color: #3aafa9;
            text-decoration: none;
            font-weight: bold;
        }

        .destination-card a:hover {
            text-decoration: underline;
        }

     
    </style>
</head>

<body style="background-color: #f8f9fa;">
  <?php include("frontend/header.php"); ?>

  <!-- Hero Section -->
  <div class="hero">
    <h1>Explore popular destinations</h1>
    <p>A new journey begins here within, find a destination that suits you and start travelling.</p>
  </div>

  <!-- Destination Cards Section -->
<div class="container py-5">
    <div class="row g-4">
        <?php if ($destResult && $destResult->num_rows > 0): ?>
            <?php while ($dest = $destResult->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="destination-card h-100">
                        <a href="view-destination?destination_id=<?php echo $dest['destination_id']; ?>">
                            <?php if (!empty($dest['dest_image'])): ?>
                                <img src="<?php echo htmlspecialchars($dest['dest_image']); ?>" alt="<?php echo htmlspecialchars($dest['destination']); ?>">
                            <?php else: ?>
                                <div class="d-flex justify-content-center align-items-center bg-light text-muted" style="height: 200px;">
                                    No image
                                </div>
                            <?php endif; ?>
                        </a>
                        <div class="destination-card-body">
                            <h5 class="destination-card-title">
                                <a href="view-destination?destination_id=<?php echo $dest['destination_id']; ?>">
                                    <?php echo htmlspecialchars($dest["destination"]); ?>
                                </a>
                            </h5>
                            <p class="destination-card-text">
                                <?php
                                    $description = $dest['description'];
                                    $words = explode(" ", $description);
                                    $firstTenWords = implode(" ", array_slice($words, 0, 20));
                                    echo htmlspecialchars($firstTenWords) . '...';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center text-muted py-4">No destinations found.</div>
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
