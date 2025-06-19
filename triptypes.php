<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connection.php';

// Fetch all triptypes with main_image from the database
$sql = "SELECT triptype_id, triptype, description, main_image FROM triptypes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripTypes</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <?php include("frontend/header.php"); ?>
    <div class="relative flex items-center justify-center h-64 bg-cover bg-center" style="background-image: url('assets/img/nature.jpg');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative z-10 text-center">
            <h1 class="text-4xl font-bold text-white drop-shadow-lg">Trip Types</h1>
        </div>
    </div>
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 py-8">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($trip = $result->fetch_assoc()): ?>
                <div class="card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <div class="relative">
                        <a href="view-trip?tripid=<?php echo $trip['triptype_id']; ?>">
                            <?php if (!empty($trip['main_image'])): ?>
                                <img src="<?php echo htmlspecialchars($trip['main_image']); ?>" class="h-64 w-full object-cover rounded-t-lg" alt="<?php echo htmlspecialchars($trip['triptype']); ?>">
                            <?php else: ?>
                                <div class="h-64 w-full flex items-center justify-center bg-gray-200 rounded-t-lg text-gray-400">No image</div>
                            <?php endif; ?>
                        </a>
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
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-3 text-center text-gray-500 py-8">No trip types found.</div>
        <?php endif; ?>
    </div>
    <?php include("frontend/footer.php"); ?>
</body>
</html>
<?php
$conn->close();
?>
