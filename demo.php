<?php
include("frontend/session_start.php");
include("connection.php");

$stmt = $conn->prepare("SELECT trips.*, trip_images.main_image FROM trips INNER JOIN trip_images ON trips.tripid = trip_images.tripid");
$stmt->execute();
$trip_result = $stmt->get_result();
?>

<?php if ($trip_result->num_rows > 0): ?>
    <?php while ($trip = $trip_result->fetch_assoc()): ?>
        <div class="card" style="flex: 0 0 calc(33.33% - 20px);">
            <div class="position-relative">
                <div class="carousel">
                    <div class="carousel-container">
                        <a href="view-trip.php?id=<?php echo $trip['tripid']; ?>">
                            <img src="<?php echo $trip['main_image']; ?>" class="slide active" alt="Trip Image">
                        </a>
                    </div>
                </div>
                <span class="badge-featured">Featured</span>
            </div>
            <div class="card-top">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center" style="padding:10px 0;">
                        <a href="view-trip.php?id=<?php echo $trip['tripid']; ?>" style="text-decoration:none; color:black;"
                            onmouseover="this.style.color='#008080'" onmouseout="this.style.color='black'">
                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($trip["title"]); ?></h5>
                        </a>
                    </div>
                    <div class="me-3 card-contents" style="padding:10px 0; border-bottom:1px solid gray;">
                        <p class="mb-1">Travel is the movement of people between relatively distant geographical...</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="d-flex mb-3">
                    <div class="me-3 card-contents" style="padding-left:15px;">
                        <p class="mb-1"><i class="fas fa-map-marker-alt" style="color:green; margin-right:10px;"></i>France,
                            India, Nepal, Srilanka</p>
                        <p class="mb-1"><i class="fas fa-clock" style="color:green; margin-right:5px;"></i>5 Hours</p>
                        <p class="mb-1"><i class="fas fa-users" style="color:green; margin-right:2px;"></i>1-10 People</p>
                    </div>
                    <div class="me-3 card-contents">
                        <div class="price" style="margin-top:50%;">
                            <h2><?php echo "$" . number_format(3000); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>