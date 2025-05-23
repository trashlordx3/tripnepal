<?php
// Database connection settings
require '../connection.php';
// session_start();

// Delete activity if delete request is received
if (isset($_POST['delete_act'])) {
    // Get the user ID to delete
    $act_id = $_POST['act_id'];
    
    // Make sure the user ID is valid
    if (!empty($act_id) && is_numeric($act_id)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM activity WHERE aid = ?");
        
        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $act_id);
            
            // Execute the statement and check if it was successful
            if ($stmt->execute()) {
                // Redirect to prevent form resubmission
                header("Location: listactivities.php?delete=success");
                exit();
            } else {
                $delete_error = "Error executing delete: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            $delete_error = "Error preparing delete statement: " . $conn->error;
        }
    } else {
        $delete_error = "Invalid activity ID";
    }
}

// Fetch all users
$sql = "SELECT aid, act_name, act_desc, act_image, status, created_at FROM activity";
$result = $conn->query($sql);

// Check if query was successful
if ($result === false) {
    // Log the error for debugging
    error_log("SQL Error: " . $conn->error);
    // Set an empty result for the table to handle gracefully
    $result = new stdClass();
    $result->num_rows = 0;
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

            // Search functionality
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.querySelectorAll("#userTable tbody tr");
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchValue) ? "" : "none";
                });
            });

            // Confirm delete
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (confirm('Are you sure you want to delete this user?')) {
                        this.closest('form').submit();
                    }
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

        <!-- main section -->
        <div class="ml-64 p-6 w-[84%] mx-auto">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4"><br></h1>
                <div class="bg-gray-100 p-4 rounded-lg mb-6">
                    <h2 class="text-3xl font-bold text-gray-800 mt-6 tracking-tighter">All Activities</h2>

                    <?php
                    // Display success message if user was deleted
                    if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
                        echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                                <strong>Success!</strong> Activity has been deleted.
                              </div>';
                    }
                    
                    // Display error message if there was an error deleting the user
                    if (isset($delete_error)) {
                        echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                                <strong>Error!</strong> ' . $delete_error . '
                              </div>';
                    }

                    // Display error message if there was an SQL error
                    if ($result === false) {
                        echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                                <strong>Database Error:</strong> Unable to fetch activity. Please check your database connection.
                              </div>';
                    }
                    ?>
                         <!-- Search Bar -->
                        <div class="mt-4 mb-6">
                            <input type="text" id="searchInput" placeholder="Search users..." class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- User Table -->
                        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
                            <table class="min-w-full" id="userTable">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Activity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                <?php
                                if ($result !== false && $result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        // Determine status color
                                        $statusColor = 'bg-gray-200 text-gray-800'; // Default
                                        if ($row['status'] === 'Active') {
                                            $statusColor = 'bg-green-200 text-green-800';
                                        } elseif ($row['status'] === 'Draft') {
                                            $statusColor = 'bg-yellow-200 text-yellow-800';
                                        } elseif ($row['status'] === 'Expired') {
                                            $statusColor = 'bg-red-200 text-red-800';
                                        }

                                        echo '<tr>';
                                        // Display image properly
                                        echo '<td class="px-6 py-4">
                                                <img src="' . htmlspecialchars($row['act_image']) . '" alt="Activity Image" class="w-max h-max object-cover rounded-lg">
                                            </td>';
                                        echo '<td class="px-6 py-4">' . htmlspecialchars($row['act_name']) . '</td>';
                                        echo '<td class="px-6 py-4">' . htmlspecialchars($row['act_desc']) . '</td>';
                                        echo '<td class="px-6 py-4">
                                                <span class="px-2 py-1 rounded-lg ' . $statusColor . '">' . htmlspecialchars($row['status']) . '</span>
                                            </td>';
                                        echo '<td class="px-6 py-4">
                                                <a href="editactivity.php?id=' . $row['aid'] . '" class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i></a>
                                                <form method="post" style="display:inline;" action="listactivities.php">
                                                    <input type="hidden" name="act_id" value="' . $row['aid'] . '">
                                                    <button type="submit" name="delete_act" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>';
                                        echo '</tr>';
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
