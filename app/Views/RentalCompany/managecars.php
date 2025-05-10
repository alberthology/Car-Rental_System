<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Company Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background: url('<?= base_url("public/assets/images/car4.jpg") ?>');
            background-size: cover;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #34495e;
            cursor: pointer;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li:hover {
            background: #34495e;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }
        
        .table-container {
            width: 90%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .add-btn {
            background: #27ae60;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 10px auto;
            margin-right: 45px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #2c3e50;
            color: white;
        }
        
        .edit-btn, .disable-btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: white;
        }

        .edit-btn {
            background: #3498db;
        }

        .disable-btn {
            background: #e74c3c;
        }

        .modal, .modal-overlay {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 50%;
        }

        .modal-overlay {
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            position: fixed;
            top: 0;
            left: 0;
        }

        .close-btn {
            background: #2c3e50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .sidebar ul li.active {
            background:rgb(36, 105, 174); /* Full background color */
            color: white;
            font-weight: bold;
            border-left: none; /* Remove left border */
            border-radius: 5px; /* Optional: Round the edges */


        }
       
        .nav-bar-card {
            background: rgba(1, 69, 105, 0.74);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .nav-bar-card h1 {
            margin: 0;
            font-size: 28px;
            color: black;
            margin-left: 350px;
        }

        /* Add these styles for the form */
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .button-group {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        
        .submit-btn {
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .submit-btn:hover {
            background: #219a52;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .notification-icon {
            font-size: 25px;
            cursor: pointer;
        }

        .notification-icon span {
            font-size: 12px;
        }
        /* Notification Styles */
        .notification-container {
            position: relative;
            display: inline-block;
            margin-left: auto;
            margin-right: 10px;
        }

        .notification-bell {
            font-size: 24px;
            cursor: pointer;
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: 30px;
            right: 0;
            background: white;
            min-width: 220px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border-radius: 5px;
            z-index: 100;
        }

        /* Add this CSS class */
        .show {
            display: block !important;
        }

        .notification-dropdown a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }

        .notification-dropdown a:hover {
            background-color: #f5f5f5;
        }

        .notification-dropdown a strong {
            display: block;
            margin-bottom: 4px;
        }

        .notification-dropdown a small {
            color: #666;
            font-size: 12px;
        }

    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
        <h2>Rental Company Dashboard</h2>
    <ul>
            <li><a href="<?= base_url('RentalCompany/company') ?>">Homepage</a></li>
            <li class="active"><a href="<?= base_url('RentalCompany/managecars') ?>">Manage Cars</a></li>
            <li><a href="<?= base_url('RentalCompany/managerent') ?>">Manage Rent</a></li>
            <li><a href="<?= base_url('RentalCompany/reports') ?>">Reports</a></li>
            <li><a href="<?= base_url('/logout') ?>">Logout</a></li>    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
        <!-- Nav Bar / Title Section -->
        <div class="nav-bar-card" style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Car Rental Management System</h1>

        <!-- Notification Bell -->
        <div class="notification-container">
            <div class="notification-bell" onclick="toggleNotifications()" title="Notifications">
                🔔
                <span class="notification-badge">3</span>
            </div>

            <!-- Dropdown Content -->
            <div id="notificationDropdown" class="notification-dropdown">
                <a href="<?= base_url('RentalCompany/managecars') ?>">
                    <strong>Manage Cars</strong>
                    <small>2 new car requests</small>
                </a>
                <a href="<?= base_url('RentalCompany/managerent') ?>">
                    <strong>Manage Rent</strong>
                    <small>5 pending rentals</small>
                </a>
                <a href="<?= base_url('RentalCompany/reports') ?>">
                    <strong>Reports</strong>
                    <small>Monthly report ready</small>
                </a>
            </div>
        </div>

    </div>



    <div class="dashboard">
        <button class="add-btn" id="addCarButton">➕ Add Car</button>

        <div class="table-container">
        <h3>List of Cars</h3>
            <table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Model</th>
                        <th>Brand</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="carTable">
                    <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= esc($car['car_id']) ?></td>
                        <td><?= esc($car['model']) ?></td>
                        <td><?= esc($car['brand']) ?></td>
                        <td><?= esc($car['year']) ?></td>
                        <td>
                            <span class="status-<?= strtolower($car['status']) ?>">
                                <?= esc($car['status']) ?>
                            </span>
                            <select class="status-dropdown" style="display: none;">
                                <option value="Available">Available</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </td>
                        <td>
                            <button class="update-btn">🚗 Update</button>
                            <button class="save-btn" style="display: none;">💾 Save</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Overlay -->
<!-- <div class="modal-overlay" id="modalOverlay" onclick="closeModal()"></div> -->

<!-- Add Car Modal -->
<div class="modal" id="carModal">
    <h2>Add New Car</h2>
    <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>
    <form id="addCarForm">
        <?= csrf_field() ?>
        <!-- Hidden company_id field populated from session -->
        <input type="hidden" id="company_id" name="company_id" value="<?= session()->get('user_id') ?>" required>

        <div class="form-group">
            <label for="model">Car Model:</label>
            <input type="text" id="model" name="model" required>
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>
        </div>

        <!-- Hidden status field -->
        <input type="hidden" id="status" name="status" value="Available">

        <div class="button-group">
            <button type="submit" class="submit-btn">Save Car</button>
            <button type="button" class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </form>
</div>

<!-- Update Car Modal -->
<div class="modal" id="updateCarModal">
    <h2>Update Car Status</h2>
    <form id="updateCarForm">
        <input type="hidden" id="updateCarId">
        <label for="updateStatus">Status:</label>
        <select id="updateStatus" name="updateStatus">
            <option value="Available">Available</option>
            <option value="Damaged">Damaged</option>
            <option value="Unavailable">Unavailable</option>
        </select>

        <button type="submit">Update Status</button>
        <button type="button" class="close-btn" onclick="closeUpdateModal()">Close</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let addButton = document.getElementById("addCarButton");
        if (addButton) {
            addButton.addEventListener("click", function () {
                openModal();
            });
        }

        // Add Car Form Submission
        document.getElementById("addCarForm").addEventListener("submit", function (event) {
            event.preventDefault();
            
            // Clear previous error messages
            const errorDiv = document.getElementById('errorMessages');
            errorDiv.style.display = 'none';
            errorDiv.innerHTML = '';
            
            const formData = new FormData(this);
            
            // Add CSRF token
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
            
            fetch("<?= base_url('/manage-cars/add') ?>", {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add the new car to the table
                    const table = document.getElementById("carTable");
                    const newRow = table.insertRow();
                    newRow.innerHTML = `
                        <td>${data.car.car_id}</td>
                        <td>${data.car.model}</td>
                        <td>${data.car.brand}</td>
                        <td>${data.car.year}</td>
                        <td>
                            <span class="status-${data.car.status.toLowerCase()}">${data.car.status}</span>
                            <select class="status-dropdown" style="display: none;">
                                <option value="Available">Available</option>
                                <option value="Damaged">Damaged</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </td>
                        <td>
                            <button class="update-btn">🚗 Update</button>
                            <button class="save-btn" style="display: none;">💾 Save</button>
                        </td>
                    `;
                    
                    // Close modal and reset form
                    closeModal();
                    document.getElementById("addCarForm").reset();
                    
                    // Show success message
                    alert("Car added successfully!");
                } else {
                    // Display error messages
                    errorDiv.style.display = 'block';
                    let errorMessage = data.message + '<br>';
                    
                    // Display validation errors if any
                    if (data.errors) {
                        errorMessage += '<ul>';
                        Object.values(data.errors).forEach(error => {
                            errorMessage += `<li>${error}</li>`;
                        });
                        errorMessage += '</ul>';
                    }
                    
                    // Display debug info if available
                    if (data.debug_info) {
                        console.error('Debug Info:', data.debug_info);
                    }
                    
                    errorDiv.innerHTML = errorMessage;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = 'An error occurred while adding the car. Please check the console for more details.';
            });
        });

        // Existing update button handlers
        function handleUpdateClick(button) {
            const row = button.closest('tr');
            const statusCell = row.cells[4];
            const statusSpan = statusCell.querySelector('span');
            const statusDropdown = statusCell.querySelector('.status-dropdown');
            const updateBtn = button;
            const saveBtn = row.querySelector('.save-btn');

            statusSpan.style.display = 'none';
            statusDropdown.style.display = 'inline-block';
            updateBtn.style.display = 'none';
            saveBtn.style.display = 'inline-block';
            statusDropdown.value = statusSpan.textContent.trim();
        }

        function handleSaveClick(button) {
            const row = button.closest('tr');
            const carId = row.cells[0].textContent.trim();
            const statusDropdown = row.cells[4].querySelector('.status-dropdown');
            const newStatus = statusDropdown.value;

            fetch("<?= base_url('/manage-cars/update-status') ?>", {
                method: "POST",
                headers: { 
                    "Content-Type": "application/x-www-form-urlencoded",
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `car_id=${carId}&status=${newStatus}`
            })
            .then(response => {
                if (response.ok) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Failed to update status.");
            });
        }

        // Add event listeners for update buttons
        document.querySelectorAll('.update-btn').forEach(button => {
            button.addEventListener('click', function() {
                handleUpdateClick(this);
            });
        });

        document.querySelectorAll('.save-btn').forEach(button => {
            button.addEventListener('click', function() {
                handleSaveClick(this);
            });
        });
    });

    function openModal() {
        document.getElementById("carModal").style.display = "block";
        document.getElementById("modalOverlay").style.display = "block";
    }

    function closeModal() {
        document.getElementById("carModal").style.display = "none";
        document.getElementById("modalOverlay").style.display = "none";
    }

    function openUpdateModal(carId) {
        document.getElementById("updateCarId").value = carId;
        document.getElementById("updateCarModal").style.display = "block";
        document.getElementById("modalOverlay").style.display = "block";
    }

    function closeUpdateModal() {
        document.getElementById("updateCarModal").style.display = "none";
        document.getElementById("modalOverlay").style.display = "none";
    }

     // Toggle dropdown visibility
     function toggleNotifications() {
        var dropdown = document.getElementById("notificationDropdown");
        if (dropdown) {
            dropdown.classList.toggle("show");
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById("notificationDropdown");
        var bell = document.querySelector('.notification-bell');
        
        if (dropdown && bell && !bell.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
</script>

</body>
</html>
