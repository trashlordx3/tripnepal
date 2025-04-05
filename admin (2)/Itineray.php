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
                toggle.addEventListener('click', function () {
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
        <div class="ml-64 p-6 w-full mt-16">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4"><br></h1>
                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                    <h2 class="text-xl font-semibold mb-4">Create Itineary</h2>
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700">Trip id:</label>
                                <input type="number" class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                            <div>
                                <label class="block text-gray-700">Days:</label>
                                <input type="text" class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                            <div>
                                <label class="block text-gray-700">Title:</label>
                                <input type="text" class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                            <div>
                                <label class="block text-gray-700">Description:</label>
                                <input type="text" class="w-full border border-gray-300 rounded-lg p-2">
                            </div>
                        </div>
                        <div class="md:col-span-2 flex justify-end space-x-4">
                            <button type="submit" class="bg-[#008080] text-white px-4 py-2 rounded">Create </button>
                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>