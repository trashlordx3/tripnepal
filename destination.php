<?php
include("frontend/session_start.php");
include("connection.php");

// Fetch active destinations from DB
$sql = "SELECT * FROM destination WHERE status = 'active'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    
    <link rel="stylesheet" href="index.css">
    <style>
        .trip-types {
            padding: 60px 15px;
            text-align: center;
        }

        .trip-types h1 {
            font-size: 2.5rem;
            color: #17252a;
            margin-bottom: 20px;
        }

        .trip-types p {
            color: #3aafa9;
            font-size: 1.2rem;
            margin-bottom: 40px;
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
            height: 250px; /* increased from 200px */
            object-fit: cover;
            display: block;
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
            color: white;
        }

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

        .view-trip-btn {
            display: inline-block;
            background-color: white;
            border: 1px solid #2c7a7b;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .view-trip-btn:hover {
            background-color: #285e61; /* Tailwind's teal-700 */
        }

    </style>
</head>

<?php
include("frontend/header.php");
?>
<header class="hero">
    <h1>Available Destinations</h1>
</header>

<div class="trip-types">
    <h1>Explore by destinations</h1>
    <p>Discover the best travel destination in nepal.</p>
    <div class="container">
        <div class="row g-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="trip-card">
                            <?php
                                $imgPath = $row['dest_image'];
                                $imgPath = str_replace('../', '', $imgPath); // normalize path
                            ?>
                                <img src="<?php echo $imgPath; ?>" alt="<?php echo htmlspecialchars($row['dest_name']); ?>" class="img-fluid">
                            <div class="trip-card-body">
                                <h3 class="trip-card-title"><?php echo htmlspecialchars($row['dest_name']); ?></h3>
                                <p class="trip-card-text">
                                <?php echo htmlspecialchars(substr($row['dest_desc'], 0, 120)) . '...'; ?></p>
                               <a href="destinations?destination-is=<?php echo urlencode($row['dest_name']); ?>" class="view-trip-btn">
                                    View Trip
                                </a>


                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No destinations available at the moment.</p>
            <?php endif; ?>

        </div>
    </div>
</div>



<?php
include("frontend/footer.php");
?>
<?php
include("frontend/scrollup.html");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>