<?php
require'../connection.php';

// Fetch trip types for dropdown
$triptypes = [];
$stmt = $conn->prepare("SELECT triptype_id, triptype FROM triptypes");
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $triptypes = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    die("Error fetching trip types: " . $conn->error);
}

if (!isset($_GET['id'])) {
    header("Location: alltrip.php");
    exit();
}

$tripId = $_GET['id'];

// Fetch trip data with images
$trip = [];
$stmt = $conn->prepare("
    SELECT trips.*, trip_images.main_image, trip_images.side_image1, trip_images.side_image2 
    FROM trips 
    LEFT JOIN trip_images ON trips.tripid = trip_images.tripid 
    WHERE trips.tripid = ?
");
$stmt->bind_param("i", $tripId);
if ($stmt->execute()) {
    $result = $stmt->get_result();
    $trip = $result->fetch_assoc();
    $stmt->close();
    if (!$trip) die("Trip not found");
} else {
    die("Error fetching trip: " . $conn->error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Update main trip data
        $stmt = $conn->prepare("UPDATE trips SET
            title = ?, price = ?, transportation = ?, accomodation = ?,
            maximumaltitude = ?, departurefrom = ?, bestseason = ?, triptype_id = ?,
            meals = ?, language = ?, fitnesslevel = ?, groupsize = ?,
            minimumage = ?, maximumage = ?, description = ?, location = ?,
            duration = ?, status = ?
            WHERE tripid = ?
        ");

        $stmt->bind_param(
            "sdsssssissssiissssi",
            $_POST['title'],
            $_POST['price'],
            $_POST['transportation'],
            $_POST['accomodation'],
            $_POST['maximumaltitude'],
            $_POST['departurefrom'],
            $_POST['bestseason'],
            $_POST['triptype_id'],
            $_POST['meals'],
            $_POST['language'],
            $_POST['fitnesslevel'],
            $_POST['groupsize'],
            $_POST['minimumage'],
            $_POST['maximumage'],
            $_POST['description'],
            $_POST['location'],
            $_POST['duration'],
            $_POST['status'],
            $tripId
        );

        if (!$stmt->execute()) {
            throw new Exception("Update failed: " . $stmt->error);
        }
        $stmt->close();

        // Handle images
        $uploadDir = 'uploads/tripimg/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        // Check if images row exists
        $stmt = $conn->prepare("SELECT * FROM trip_images WHERE tripid = ?");
        $stmt->bind_param("i", $tripId);
        $stmt->execute();
        $result = $stmt->get_result();
        $imageRow = $result->fetch_assoc();
        $stmt->close();

        if (!$imageRow) {
            $stmt = $conn->prepare("INSERT INTO trip_images (tripid) VALUES (?)");
            $stmt->bind_param("i", $tripId);
            $stmt->execute();
            $stmt->close();
        }

        // Process image updates
        $imageFields = ['main_image', 'side_image1', 'side_image2'];
        foreach ($imageFields as $field) {
            if (!empty($_FILES[$field]['name'])) {
                $fileName = uniqid() . '_' . basename($_FILES[$field]['name']);
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES[$field]['tmp_name'], $targetPath)) {
                    $stmt = $conn->prepare("UPDATE trip_images SET $field = ? WHERE tripid = ?");
                    $stmt->bind_param("si", $targetPath, $tripId);
                    $stmt->execute();
                    $stmt->close();
                }
            }
            
            // Handle deletions
            if (isset($_POST['deleted_images']) && 
                in_array($field, explode(',', $_POST['deleted_images']))) {
                $stmt = $conn->prepare("UPDATE trip_images SET $field = NULL WHERE tripid = ?");
                $stmt->bind_param("i", $tripId);
                $stmt->execute();
                $stmt->close();
            }
        }

        $_SESSION['success'] = "Trip updated successfully!";
        header("Location: alltrip.php");
        exit();

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip Management - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <style>
        .table-container {
            max-height: 600px;
            overflow-y: auto;
        }
        
        .status-badge {
            @apply px-2 py-1 text-xs font-semibold rounded-full;
        }
        
        .status-active {
            @apply bg-green-100 text-green-800;
        }
        
        .status-expired {
            @apply bg-red-100 text-red-800;
        }
        
        .status-featured {
            @apply bg-blue-100 text-blue-800;
        }
        
        .btn-action {
            @apply px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200;
        }
        
        .btn-edit {
            @apply bg-blue-500 text-white hover:bg-blue-600;
        }
        
        .btn-delete {
            @apply bg-red-500 text-white hover:bg-red-600;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dropdown functionality
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== this.nextElementSibling) {
                            menu.classList.add('hidden');
                        }
                    });
                    const dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle('hidden');
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function (event) {
                if (!event.target.closest('.dropdown-toggle')) {
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });

        });
    </script>
</head>   <!-- Same head content as before -->

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex h-screen">
            <!-- Sidebar -->
             <?php include("frontend/asidebar.php"); ?>
        <!-- Main section -->
    <div class="ml-64 p-6 w-[84%] mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mt-6 tracking-tighter">Edit Trip</h1>
                        <a href="alltrip.php" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to List
                        </a>
            </div>  
            <form method="POST" enctype="multipart/form-data" class="space-y-6 mt-8">
                <!-- Main Trip Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Trip Title</label>
                                <input type="text" name="title" 
                                        value="<?= htmlspecialchars($trip['title']) ?>" 
                                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Transportation</label>
                            <select name="status" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="Bus" <?= $trip['transportation'] === 'Bus' ? 'selected' : '' ?>>Bus</option>
                                        <option value="Car" <?= $trip['transportation'] === 'Car' ? 'selected' : '' ?>>Car</option>
                                        <option value="Helicopter" <?= $trip['transportation'] === 'Helicopter' ? 'selected' : '' ?>>Helicopter</option>
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Short Description</label>
                            <textarea name="trip_desc" rows="4"value="<?= htmlspecialchars($trip['description']) ?>" class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    required>
                                    </textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Trip Type</label>
                            <select name="triptype_id" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <?php foreach ($triptypes as $type): ?>
                                    <option value="<?= $type['triptype_id'] ?>" <?= $trip['triptype_id'] == $type['triptype_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($type['triptype']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" value="<?= htmlspecialchars($trip['location']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>    
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" value="<?= htmlspecialchars($trip['price']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="active" <?= $trip['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="expired" <?= $trip['status'] === 'expired' ? 'selected' : '' ?>>Expired</option>
                                        <option value="draft" <?= $trip['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                            </select>
                    </div>  
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Best Season</label>
                            <select name="season" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="Winter" <?= $trip['bestseason'] === 'Winter' ? 'selected' : '' ?>>Winter</option>
                                        <option value="Summer" <?= $trip['bestseason'] === 'Summer' ? 'selected' : '' ?>>Summer</option>
                                        <option value="Spring" <?= $trip['bestseason'] === 'Spring' ? 'selected' : '' ?>>Spring</option>
                                        <option value="Autumn" <?= $trip['bestseason'] === 'Autumn' ? 'selected' : '' ?>>Autumn</option>
                            </select>
                    </div>      
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Departure From</label>
                            <select name="departure" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="Kathmandu" <?= $trip['departurefrom'] === 'Kathmandu' ? 'selected' : '' ?>>Kathmandu</option>
                                        <option value="Lalitpur" <?= $trip['departurefrom'] === 'Lalitpur' ? 'selected' : '' ?>>Lalitpur</option>
                                        <option value="Bhaktapur" <?= $trip['departurefrom'] === 'Bhaktapur' ? 'selected' : '' ?>>Bhaktapur</option>
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Accomodation</label>
                                    <input type="text" name="accomodation" value="<?= htmlspecialchars($trip['accomodation']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>

                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Duration</label>
                            <input type="number" name="duration" value="<?= htmlspecialchars($trip['duration']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Meals</label>
                            <input type="text" name="meal" value="<?= htmlspecialchars($trip['meals']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                    </div>                    
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Language</label>
                            <input type="text" name="language" value="<?= htmlspecialchars($trip['language']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Fitness Level</label>
                            <select name="fitness" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="Beginner" <?= $trip['fitnesslevel'] === 'Beginner' ? 'selected' : '' ?>>Beginner</option>
                                        <option value="Medium" <?= $trip['fitnesslevel'] === 'Medium' ? 'selected' : '' ?>>Medium</option>
                                        <option value="High" <?= $trip['fitnesslevel'] === 'High' ? 'selected' : '' ?>>High</option>
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Group Size</label>
                            <select name="size" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="1" <?= $trip['groupsize'] === '2' ? 'selected' : '' ?>>2</option>
                                        <option value="2" <?= $trip['groupsize'] === '2-6' ? 'selected' : '' ?>>2-6</option>
                                        <option value="3" <?= $trip['groupsize'] === '6-14' ? 'selected' : '' ?>>6-14</option>
                                        <option value="4" <?= $trip['groupsize'] === '14-More' ? 'selected' : '' ?>>14-More</option>
                            </select>
                    </div>        
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Minimum Age</label>
                            <input type="number" name="minage" value="<?= htmlspecialchars($trip['minimumage']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Maximum Age</label>
                            <input type="number" name="maxage" value="<?= htmlspecialchars($trip['maximumage']) ?>" 
                                    class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    required>
                    </div>        
                </div>

                <!-- Image Upload Section -->
                <div>
                    <label class="form-label">Trip Images</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <?php foreach (['main_image', 'side_image1', 'side_image2'] as $index => $field): ?>
                        <div class="image-upload group relative" id="<?= $field ?>_container">
                            <?php if (!empty($trip[$field])): ?>
                                <div class="image-preview" style="background-image: url('<?= $trip[$field] ?>')"></div>
                                <button type="button" class="delete-existing-image delete-btn" data-field="<?= $field ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            <?php else: ?>
                                <div class="image-upload-icon">+</div>
                                <input type="file" name="<?= $field ?>" class="hidden" accept="image/*">
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="deleted_images" id="deleted_images" value="">
                </div>

                <!-- Other form fields... -->

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">
                        Update Trip
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Upload Handling
        const handleImageUpload = (container) => {
            const input = container.querySelector('input[type="file"]');
            const preview = container.querySelector('.image-preview');
            const deleteBtn = container.querySelector('.delete-existing-image');

            if (input) {
                container.addEventListener('click', () => input.click());
                
                input.addEventListener('change', function() {
                    if (this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            container.innerHTML = `
                                <div class="image-preview" style="background-image: url('${e.target.result}')"></div>
                                <button type="button" class="delete-btn" onclick="resetImageField('${input.name}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                     </svg>
                                </button>
                            `;
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            if (deleteBtn) {
                deleteBtn.addEventListener('click', function() {
                    const field = this.dataset.field;
                    const deletedInput = document.getElementById('deleted_images');
                    const deleted = deletedInput.value ? deletedInput.value.split(',') : [];
                    
                    if (!deleted.includes(field)) {
                        deleted.push(field);
                        deletedInput.value = deleted.join(',');
                    }
                    
                    // Reset to upload state
                    container.innerHTML = `
                        <div class="image-upload-icon">+</div>
                        <input type="file" name="${field}" class="hidden" accept="image/*">
                    `;
                    handleImageUpload(container);
                });
            }
        };

        // Initialize all image containers
        document.querySelectorAll('.image-upload').forEach(container => {
            handleImageUpload(container);
        });
    });
    </script>
</body>
</html>