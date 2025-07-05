<?php
session_start();
require 'frontend/connection.php'; // Adjust if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $destination = $_POST['dest_name'];
    $description = $_POST['dest_description'];
    $status = $_POST['status'];
    $uploadDir = '../uploads/destination/';

    function uploadFile($inputName, $uploadDir) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES[$inputName]['tmp_name'];
            $originalName = basename($_FILES[$inputName]['name']);
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($ext, $allowed)) {
                $newName = uniqid() . '.' . $ext;
                $destPath = $uploadDir . $newName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($tmpName, $destPath)) {
                    return 'uploads/destination/' . $newName; // return relative path
                }
            }
        }
        return null;
    }

    $imagePath = uploadFile('dest_image', $uploadDir);

    if ($imagePath) {
        $stmt = $conn->prepare("INSERT INTO destination (destination, description, dest_image, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $destination, $description, $imagePath, $status);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Destination added successfully!";
        } else {
            $_SESSION['message'] = "Error: Failed to insert into database.";
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Error: Image upload failed.";
    }

    $conn->close();
    header("Location: newdestination.php");
    exit();
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
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex h-screen">
        <?php include("frontend/asidebar.php"); ?>

        <div class="ml-64 p-6 w-[84%] mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                    <h1 class="text-3xl font-bold text-gray-800 mt-6 tracking-tighter">Add New Destination</h1>
                    <form action="newdestination.php" method="POST" enctype="multipart/form-data">
                        <div class="mt-8">
                            <label for="dest_name" class="block text-sm font-medium text-gray-700 mb-1">Destination Name</label>
                            <input type="text" id="dest_name" name="dest_name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-[#008080]">
                        </div>

                        <div class="mb-4 pt-4">
                            <label for="dest_description" class="block text-sm font-medium text-gray-700 mb-1">Destination Description</label>
                            <textarea id="dest_description" name="dest_description" rows="4" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-[#008080]"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="dest_image" class="block text-sm font-medium text-gray-700 mb-1">Destination Image</label>
                            <div class="flex items-center justify-center w-full">
                                <label for="dest_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div id="upload-label" class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">PNG, JPG or GIF (MAX. 2MB)</p>
                                    </div>
                                    <input id="dest_image" name="dest_image" type="file" class="hidden" accept="image/*" />
                                    <div id="image-preview" class="p-2 w-full h-full flex justify-start"></div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#008080] focus:border-[#008080]">
                                <option value="" disabled selected>Select status</option>
                                <option value="active">Active</option>
                                <option value="expired">Expired</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>

                        <div>
                            <button type="submit" 
                                class="w-full bg-[#008080] hover:bg-[#006666] text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-[#008080] focus:ring-offset-2 transition-colors">
                                Add Destination
                            </button>
                        </div>
                    </form>

                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="fixed top-4 right-4 z-50">
                            <div class="<?= strpos($_SESSION['message'], 'Error') === 0 ? 'bg-red-50 border-red-400 text-red-700' : 'bg-green-50 border-green-400 text-green-700' ?> rounded border px-4 py-3 mb-4 transition-all duration-300 transform hover:scale-[1.02] shadow-lg" role="alert">
                                <div class="flex items-center">
                                    <div class="py-1">
                                        <?php if(strpos($_SESSION['message'], 'Error') === 0): ?>
                                            <svg class="w-6 h-6 mr-2 text-red-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        <?php else: ?>
                                            <svg class="w-6 h-6 mr-2 text-green-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="font-medium"><?= htmlspecialchars($_SESSION['message']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<script>
    document.getElementById('dest_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const uploadLabel = document.getElementById('upload-label');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="max-h-32 w-auto object-cover rounded-lg">`;
                uploadLabel.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
            uploadLabel.classList.remove('hidden');
        }
    });
</script>

</body>
</html>
