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
            document.addEventListener('click', function (event) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (!menu.parentElement.contains(event.target)) {
                        menu.classList.add('hidden');
                    }
                });
            });

            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const dropdownMenu = this.nextElementSibling;
                    dropdownMenu.classList.toggle('hidden');
                });
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
        <!-- Main Content -->
        <div class="ml-64 p-6 w-full">
            <div class="bg-white shadow-md rounded-lg p-6">
             <h1 class="text-2xl font-bold text-gray-800 mt-12">Add New Trips</h1>
        
                    <form method="POST" enctype="multipart/form-data">
                         <div>
                            <label class="block text-gray-700">Title:</label>
                            <input type="text" id="title" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Price:</label>
                            <input type="number" id="Price" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div class="mb-6">
                            <label for="Transportation" class="block text-sm font-medium text-gray-700 mb-1">Transportation</label>
                            <select id="Transportation" name="Transportation" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select Transportation</option>
                                <option value="Bus">Bus</option>
                                <option value="Car">car</option>
                                <option value="Helicopter">Helicopter</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Accomodation:</label>
                            <input type="text" id="Accomodation" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Maxmimum altitude:</label>
                            <input type="number" id="Maxmimum" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div class="mb-6">
                            <label for="Depature" class="block text-sm font-medium text-gray-700 mb-1">Depature from</label>
                            <select id="Depature" name="Depature" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected> Depature From</option>
                                <option value="Kathmandu">Kathmandu</option>
                                <option value="Lalitpur">Lalitpur</option>
                                <option value="Chitwan">Chitwan</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="Session" class="block text-sm font-medium text-gray-700 mb-1">Best session</label>
                            <select id="Session" name="Session" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Best Session </option>
                                <option value="Winter">Winter</option>
                                <option value="Summer">Summer</option>
                                <option value="Spring">Spring</option>
                                <option value="Autumn">Autumn</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="triptype" class="block text-sm font-medium text-gray-700 mb-1">Trip Type</label>
                            <select id="triptype" name="triptype" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select Triptype</option>
                                <option value="Nature Friendly">Nature Friendly</option>
                                <option value="Cultural">Cultural</option>
                                <option value="Budget Friendly">Budget Friendly</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Meals:</label>
                            <input type="text" id="Meals" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Language:</label>
                            <input type="text" id="language" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div class="mb-6">
                            <label for="fitnesslevel" class="block text-sm font-medium text-gray-700 mb-1">Fitness Level</label>
                            <select id="fitnesslevel" name="fitnesslevel" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select groupsize</option>
                                <option value="Begineer">Begineer</option>
                                <option value="Medium">>Medium</option>
                                <option value="High">>High</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="groupsize" class="block text-sm font-medium text-gray-700 mb-1">Group Size</label>
                            <select id="groupsize" name="groupsize" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select groupsize</option>
                                <option value="2">2</option>
                                <option value=">8">>8</option>
                                <option value=">15">>15</option>
                                <option value="15+">15+</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Minimum Age:</label>
                            <input type="text" id="minimumage" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>
                        <div>
                            <label class="block text-gray-700">Maximum Age:</label>
                            <input type="text" id="maximumage" class="w-full p-2 border border-gray-300 rounded"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="md:col-span-2 flex justify-end space-x-4">
                            <button type="submit" class="bg-[#008080] text-white px-4 py-2 rounded">Create </button>
                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                        </div>
                    </form>
                    <!-- Display error/success messages -->
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
                <?php 
                unset($_SESSION['message']);
                endif; 
                ?>
                </div>
            </div>
        </div>
    </div>
<script>
// Image preview functionality
    document.getElementById('act_image').addEventListener('change', function(e) {
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
