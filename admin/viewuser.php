<?php
require '../connection.php';

// session_start();
// if (!isset($_SESSION['admin_id'])) {
//   header('location:adminlogin.php');
//   exit;
// }
 

// Get fresh data for display
$stmt = $conn->prepare("SELECT * FROM users ORDER BY userid DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .hover-scale {
      transition: transform 0.2s ease;
    }
    
    .hover-scale:hover {
      transform: scale(1.02);
    }

    .action-button {
      transition: all 0.3s ease;
    }
    
    .action-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .table-row {
      transition: all 0.2s ease;
    }
    
    .table-row:hover {
      background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
      transform: translateX(4px);
    }

    .status-active {
      background: linear-gradient(135deg, #10b981, #059669);
    }
    
    .status-inactive {
      background: linear-gradient(135deg, #f59e0b, #d97706);
    }
    
    .status-suspended {
      background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    @media (max-width: 768px) {
      .hidden-mobile {
        display: none;
      }
    }

    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
      height: 8px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 4px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 4px;
    }

    .search-input {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border: 2px solid transparent;
      transition: all 0.3s ease;
    }
    
    .search-input:focus {
      border-color: #667eea;
      background: rgba(255, 255, 255, 1);
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
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

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value;
                    const url = new URL(window.location);
                    if (searchTerm) {
                        url.searchParams.set('search', searchTerm);
                    } else {
                        url.searchParams.delete('search');
                    }
                    window.location.href = url.toString();
                });
            }

            // Delete confirmation
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tripName = this.dataset.tripName;
                    if (confirm(`Are you sure you want to delete "${tripName}"? This action cannot be undone.`)) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.innerHTML = `
                            <input type="hidden" name="delete_trip" value="1">
                            <input type="hidden" name="trip_id" value="${this.dataset.tripId}">
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
</head>

<body class="bg-gray-50 font-sans leading-normal tracking-normal">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <?php include("frontend/asidebar.php"); ?>
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-64">
      <main class="flex-1 p-6 mt-16">
        <!-- Header Section -->
        <div class="mb-8">
          <div class="gradient-bg rounded-2xl p-6 text-white">
            <div class="flex justify-between items-center">
              <div>
                <h1 class="text-3xl font-bold mb-2">
                  <i class="fas fa-users mr-3"></i>Users Management
                </h1>
                <p class="text-blue-100">Manage and monitor all user accounts</p>
              </div>
              <div class="text-right">
                <div class="text-2xl font-bold" id="totalUsers">
                  <?php echo $result->num_rows; ?>
                </div>
                <div class="text-blue-100">Total Users</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Controls Section -->
        <div class="glass-effect rounded-2xl p-6 mb-6 shadow-xl">
          <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <!-- Export Buttons -->
            <div class="flex flex-wrap items-center gap-3">
              <h3 class="text-lg font-semibold text-gray-700 mr-4">Export Data:</h3>
              <button onclick="printTable()" class="action-button bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-all">
                <i class="fas fa-print"></i>
                <span class="hidden sm:inline">Print</span>
              </button>
              <button onclick="exportToPDF()" class="action-button bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-all">
                <i class="fas fa-file-pdf"></i>
                <span class="hidden sm:inline">PDF</span>
              </button>
              <button onclick="exportToExcel()" class="action-button bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-all">
                <i class="fas fa-file-excel"></i>
                <span class="hidden sm:inline">Excel</span>
              </button>
            </div>

            <!-- Search and Filter -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
              <div class="flex items-center gap-2">
                <label class="text-gray-600 font-medium" for="entries">Show:</label>
                <select class="search-input border-0 rounded-lg px-3 py-2 outline-none" id="entries" onchange="changeEntries()">
                  <option value="10">10</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
                <span class="text-gray-600">entries</span>
              </div>
              
              <div class="flex items-center gap-2">
                <label class="text-gray-600 font-medium" for="search">Search:</label>
                <div class="relative">
                  <input class="search-input border-0 rounded-lg px-4 py-2 pl-10 outline-none w-64" 
                         id="search" 
                         type="text" 
                         placeholder="Search users..."
                         oninput="searchTable()" />
                  <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Table Section -->
        <div class="glass-effect rounded-2xl shadow-xl overflow-hidden">
          <div class="overflow-x-auto custom-scrollbar">
            <table class="min-w-full" id="usersTable">
              <thead class="gradient-bg text-white">
                <tr>
                  <th class="py-4 px-6 text-left font-semibold">
                    <i class="fas fa-id-card mr-2"></i>User ID
                  </th>
                  <th class="py-4 px-6 text-left font-semibold">
                    <i class="fas fa-user mr-2"></i>Name
                  </th>
                  <th class="py-4 px-6 text-left font-semibold hidden-mobile">
                    <i class="fas fa-at mr-2"></i>Username
                  </th>
                  <th class="py-4 px-6 text-left font-semibold hidden-mobile">
                    <i class="fas fa-envelope mr-2"></i>Email
                  </th>
                  <th class="py-4 px-6 text-left font-semibold hidden-mobile">
                    <i class="fas fa-phone mr-2"></i>Phone
                  </th>
                  <th class="py-4 px-6 text-left font-semibold hidden-mobile">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location
                  </th>
                  <th class="py-4 px-6 text-left font-semibold">
                    <i class="fas fa-info-circle mr-2"></i>Status
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100">
                <?php
                if ($result->num_rows > 0) {
                  while ($user = $result->fetch_assoc()) {
                    $statusClass = '';
                    $statusText = '';
                    switch($user['status']) {
                      case 'active':
                        $statusClass = 'status-active';
                        $statusText = 'Active';
                        break;
                      case 'inactive':
                        $statusClass = 'status-inactive';
                        $statusText = 'Inactive';
                        break;
                      case 'suspended':
                        $statusClass = 'status-suspended';
                        $statusText = 'Suspended';
                        break;
                      default:
                        $statusClass = 'bg-gray-500';
                        $statusText = 'Unknown';
                    }
                ?>
                <tr class="table-row hover:bg-gray-50">
                  <td class="py-4 px-6">
                    <div class="flex items-center">
                      <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                        <?php echo strtoupper(substr($user["first_name"], 0, 1) . substr($user["last_name"], 0, 1)); ?>
                      </div>
                      <span class="font-mono text-sm text-gray-600"><?php echo htmlspecialchars($user["userid"]); ?></span>
                    </div>
                  </td>
                  <td class="py-4 px-6">
                    <div>
                      <div class="font-semibold text-gray-900">
                        <?php echo htmlspecialchars($user["first_name"] . " " . $user["last_name"]); ?>
                      </div>
                      <div class="text-sm text-gray-500 lg:hidden">
                        @<?php echo htmlspecialchars($user["user_name"]); ?>
                      </div>
                    </div>
                  </td>
                  <td class="py-4 px-6 hidden-mobile">
                    <span class="text-gray-700">@<?php echo htmlspecialchars($user["user_name"]); ?></span>
                  </td>
                  <td class="py-4 px-6 hidden-mobile">
                    <a href="mailto:<?php echo htmlspecialchars($user["email"]); ?>" 
                       class="text-blue-600 hover:text-blue-800 transition-colors">
                      <?php echo htmlspecialchars($user["email"]); ?>
                    </a>
                  </td>
                  <td class="py-4 px-6 hidden-mobile">
                    <a href="tel:<?php echo htmlspecialchars($user["phone_number"]); ?>" 
                       class="text-green-600 hover:text-green-800 transition-colors">
                      <?php echo htmlspecialchars($user["phone_number"] ?: 'N/A'); ?>
                    </a>
                  </td>
                  <td class="py-4 px-6 hidden-mobile">
                    <div class="text-sm">
                      <div><?php echo htmlspecialchars($user["address"] ?: 'N/A'); ?></div>
                      <?php if ($user["country"]): ?>
                        <div class="text-gray-500"><?php echo htmlspecialchars($user["country"]); ?></div>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td class="py-4 px-6">
                    <span class="<?php echo $statusClass; ?> text-white px-3 py-1 rounded-full text-xs font-semibold">
                      <?php echo $statusText; ?>
                    </span>
                  </td>
                </tr>
                <?php 
                  }
                } else {
                ?>
                <tr>
                  <td colspan="8" class="py-8 px-6 text-center text-gray-500">
                    <i class="fas fa-users-slash text-4xl mb-4 block"></i>
                    <p class="text-lg">No users found</p>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
              <div class="text-sm text-gray-600">
                Showing <span id="startEntry">1</span> to <span id="endEntry">10</span> of <span id="totalEntries"><?php echo $result->num_rows; ?></span> entries
              </div>
              <div class="flex space-x-2" id="pagination">
                <!-- Pagination buttons will be generated by JavaScript -->
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    let currentPage = 1;
    let entriesPerPage = 10;
    let allRows = [];
    let filteredRows = [];

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
      allRows = Array.from(document.querySelectorAll('#usersTable tbody tr')).filter(row => 
        !row.querySelector('td[colspan]')
      );
      filteredRows = [...allRows];
      updateTable();
    });

    function changeEntries() {
      entriesPerPage = parseInt(document.getElementById('entries').value);
      currentPage = 1;
      updateTable();
    }

    function searchTable() {
      const searchTerm = document.getElementById('search').value.toLowerCase();
      
      if (searchTerm === '') {
        filteredRows = [...allRows];
      } else {
        filteredRows = allRows.filter(row => {
          const cells = row.querySelectorAll('td');
          return Array.from(cells).some(cell => 
            cell.textContent.toLowerCase().includes(searchTerm)
          );
        });
      }
      
      currentPage = 1;
      updateTable();
    }

    function updateTable() {
      // Hide all rows
      allRows.forEach(row => row.style.display = 'none');
      
      // Calculate pagination
      const totalEntries = filteredRows.length;
      const startIndex = (currentPage - 1) * entriesPerPage;
      const endIndex = Math.min(startIndex + entriesPerPage, totalEntries);
      
      // Show relevant rows
      for (let i = startIndex; i < endIndex; i++) {
        if (filteredRows[i]) {
          filteredRows[i].style.display = '';
        }
      }
      
      // Update pagination info
      document.getElementById('startEntry').textContent = totalEntries > 0 ? startIndex + 1 : 0;
      document.getElementById('endEntry').textContent = endIndex;
      document.getElementById('totalEntries').textContent = totalEntries;
      
      // Update pagination buttons
      updatePagination(totalEntries);
    }

    function updatePagination(totalEntries) {
      const totalPages = Math.ceil(totalEntries / entriesPerPage);
      const paginationDiv = document.getElementById('pagination');
      paginationDiv.innerHTML = '';
      
      if (totalPages <= 1) return;
      
      // Previous button
      if (currentPage > 1) {
        paginationDiv.innerHTML += `
          <button onclick="changePage(${currentPage - 1})" 
                  class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fas fa-chevron-left"></i>
          </button>`;
      }
      
      // Page numbers
      for (let i = Math.max(1, currentPage - 2); i <= Math.min(totalPages, currentPage + 2); i++) {
        const activeClass = i === currentPage ? 'bg-blue-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50';
        paginationDiv.innerHTML += `
          <button onclick="changePage(${i})" 
                  class="px-3 py-2 text-sm border border-gray-300 rounded-lg transition-colors ${activeClass}">
            ${i}
          </button>`;
      }
      
      // Next button
      if (currentPage < totalPages) {
        paginationDiv.innerHTML += `
          <button onclick="changePage(${currentPage + 1})" 
                  class="px-3 py-2 text-sm bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fas fa-chevron-right"></i>
          </button>`;
      }
    }

    function changePage(page) {
      currentPage = page;
      updateTable();
    }

    // Export Functions
    function printTable() {
      const printWindow = window.open('', '_blank');
      const tableHTML = generatePrintableTable();
      
      printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
          <title>Users Report</title>
          <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            h1 { color: #333; text-align: center; margin-bottom: 30px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #f5f5f5; font-weight: bold; }
            tr:nth-child(even) { background-color: #f9f9f9; }
            .print-date { text-align: right; color: #666; margin-bottom: 20px; }
          </style>
        </head>
        <body>
          <div class="print-date">Generated on: ${new Date().toLocaleString()}</div>
          <h1>Users Report</h1>
          ${tableHTML}
        </body>
        </html>
      `);
      
      printWindow.document.close();
      printWindow.print();
    }

    function exportToPDF() {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF('l', 'mm', 'a4'); // landscape orientation
      
      // Add title
      doc.setFontSize(18);
      doc.text('Users Report', 14, 22);
      
      // Add date
      doc.setFontSize(10);
      doc.text(`Generated on: ${new Date().toLocaleString()}`, 14, 32);
      
      // Get table data
      const tableData = getTableData();
      
      // Generate PDF table
      doc.autoTable({
        head: [['User ID', 'Name', 'Username', 'Email', 'Phone', 'Country', 'Status']],
        body: tableData,
        startY: 40,
        styles: {
          fontSize: 8,
          cellPadding: 3,
        },
        headStyles: {
          fillColor: [102, 126, 234],
          textColor: 255,
          fontStyle: 'bold'
        },
        alternateRowStyles: {
          fillColor: [249, 249, 249]
        }
      });
      
      doc.save('users-report.pdf');
    }

    function exportToExcel() {
      const tableData = getTableData();
      const ws = XLSX.utils.aoa_to_sheet([
        ['User ID', 'Name', 'Username', 'Email', 'Phone', 'Country', 'Status'],
        ...tableData
      ]);
      
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Users');
      
      XLSX.writeFile(wb, 'users-report.xlsx');
    }

    function getTableData() {
      const data = [];
      filteredRows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 0) {
          data.push([
            cells[0].textContent.trim().split('\n').pop(), // User ID
            cells[1].textContent.trim().split('\n')[0], // Name
            cells[2] ? cells[2].textContent.trim() : 'N/A', // Username
            cells[3] ? cells[3].textContent.trim() : 'N/A', // Email
            cells[4] ? cells[4].textContent.trim() : 'N/A', // Phone
            cells[5] ? cells[5].textContent.trim().split('\n').pop() || 'N/A' : 'N/A', // Country
            cells[6] ? cells[6].textContent.trim() : 'N/A' // Status
          ]);
        }
      });
      return data;
    }

    function generatePrintableTable() {
      const tableData = getTableData();
      let html = `
        <table>
          <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Country</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
      `;
      
      tableData.forEach(row => {
        html += '<tr>';
        row.forEach(cell => {
          html += `<td>${cell}</td>`;
        });
        html += '</tr>';
      });
      
      html += '</tbody></table>';
      return html;
    }
  </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>