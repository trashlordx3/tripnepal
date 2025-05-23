<?php
require '../connection.php';

$act = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $act_id = filter_input(INPUT_POST, 'act_id', FILTER_VALIDATE_INT);
        $act_name = trim($_POST['act_name']);
        $act_desc = trim($_POST['act_desc']);
        $status = trim($_POST['status']);
        $current_image = trim($_POST['current_image']);

        // Validation
        if (empty($act_name)) throw new Exception("Error: Activity name is required");
        if (empty($act_desc)) throw new Exception("Error: Description is required");
        if (empty($status)) throw new Exception("Error: Status is required");

        // Handle file upload
        $targetFile = $current_image;
        if (!empty($_FILES['act_image']['name'])) {
            $targetDir = "uploads/";
            $fileName = basename($_FILES["act_image"]["name"]);
            $targetFile = $targetDir . uniqid() . '_' . $fileName;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowedTypes)) {
                throw new Exception("Error: Only JPG, JPEG, PNG & GIF files are allowed.");
            }

            if ($_FILES["act_image"]["size"] > 5000000) {
                throw new Exception("Error: File is too large. Max 5MB allowed.");
            }

            if (!move_uploaded_file($_FILES["act_image"]["tmp_name"], $targetFile)) {
                throw new Exception("Error: Error uploading file.");
            }
        }

        // Update query
        $stmt = $conn->prepare("UPDATE activity SET 
            act_name = ?,
            act_desc = ?,
            act_image = ?,
            status = ?
            WHERE aid = ?");

        $stmt->bind_param("ssssi", 
            $act_name,
            $act_desc,
            $targetFile,
            $status,
            $act_id
        );

        if (!$stmt->execute()) {
            throw new Exception("Error: " . $stmt->error);
        }

        $_SESSION['message'] = "Success: Activity updated successfully!";
        header("Location: listactivities.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header("Location: editactivity.php?id=" . $act_id);
        exit();
    }
} else {
    if (isset($_GET['id'])) {
        $act_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if ($act_id) {
            $stmt = $conn->prepare("SELECT * FROM activity WHERE aid = ?");
            $stmt->bind_param("i", $act_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $act = $result->fetch_assoc();
            
            if (!$act) {
                $_SESSION['message'] = "Error: Activity not found";
                header("Location: listactivities.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Error: Invalid activity ID";
            header("Location: listactivities.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error: Activity ID not specified";
        header("Location: listactivities.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    
                    // Close all dropdowns
                    document.querySelectorAll('.dropdown-menu').forEach(menu => {
                        if (menu !== this.nextElementSibling) {
                            menu.classList.add('hidden');
                        }
                    });

                    // Toggle current dropdown
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

            document.getElementById('act_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            const currentImage = document.getElementById('current-image');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="max-h-48 w-auto object-cover rounded-lg">`;
                    currentImage.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        });
    </script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
   <div class="flex h-screen">
        <!-- Sidebar -->
            <?php
            include("frontend/asidebar.php");
            ?>

        <!-- main section -->
        <div class="ml-64 p-6 w-[84%] mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4"><br></h1>
                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Edit Activity</h1>
                        <a href="listactivities.php" 
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to List
                        </a>
                    </div>
                    <!-- <form id="editForm" class="grid grid-cols-1 md:grid-cols-2 gap-4"> -->
                        <?php include('messages.php') ?> <!-- Create separate messages file or use previous message code -->

                        <form action="editactivity.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                            <input type="hidden" name="act_id" value="<?= htmlspecialchars($act['aid']) ?>">
                            <input type="hidden" name="current_image" value="<?= htmlspecialchars($act['act_image']) ?>">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Activity Name -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Activity Name</label>
                                    <input type="text" name="act_name" 
                                        value="<?= htmlspecialchars($act['act_name']) ?>" 
                                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>

                                <!-- Status -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="Active" <?= $act['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                                        <option value="Expired" <?= $act['status'] === 'Expired' ? 'selected' : '' ?>>Expired</option>
                                        <option value="Draft" <?= $act['status'] === 'Draft' ? 'selected' : '' ?>>Draft</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="act_desc" rows="4"
                                    class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    required><?= htmlspecialchars($act['act_desc']) ?></textarea>
                            </div>

                            <!-- Image Upload -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Activity Image</label>
                                <div class="flex items-center gap-4">
                                    <div id="current-image" class="w-48">
                                        <img src="<?= htmlspecialchars($act['act_image']) ?>" 
                                            class="max-h-48 w-auto object-cover rounded-lg border">
                                        <span class="text-xs text-gray-500">Current Image</span>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center justify-center w-full">
                                            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg class="w-8 h-8 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500">
                                                        <span class="font-semibold">Click to upload</span>
                                                    </p>
                                                    <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 5MB)</p>
                                                </div>
                                                <input id="act_image" name="act_image" type="file" class="hidden" accept="image/*">
                                            </label>
                                        </div>
                                        <div id="image-preview" class="mt-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end space-x-4">
                                <a href="allactivities.php" 
                                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Cancel
                                </a>
                                <button type="submit" 
                                     class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                     <i class="fas fa-save mr-2"></i>
                                    Update Activity
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
        