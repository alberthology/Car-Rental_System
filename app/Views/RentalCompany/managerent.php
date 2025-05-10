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
            background: url('<?= base_url("public/assets/images/car4.jpg") ?>') no-repeat center center fixed;
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

        .sidebar ul li:hover,
        .sidebar ul li.active {
            background: rgb(36, 105, 174);
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
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

        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .tab-buttons button {
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            background: #2c3e50;
            color: white;
            width: 200px;
            height: 60px;
            font-size: medium;
        }

        .tab-buttons button.active {
            background: #3498db;
        }

        .content-section {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content-section.active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        .approve-btn { background: #27ae60; }
        .reject-btn { background: #c0392b; }
        .track-btn { background: #3498db; }

        .status-pending { color: #f39c12; font-weight: bold; }
        .status-approved { color: #27ae60; font-weight: bold; }
        .status-rejected { color: #c0392b; font-weight: bold; }
        .status-damaged { color: #e74c3c; font-weight: bold; }
        .status-unavailable { color: #95a5a6; font-weight: bold; }

        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            border-radius: 8px;
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
        <li><a href="<?= base_url('RentalCompany/managecars') ?>">Manage Cars</a></li>
        <li class="active"><a href="<?= base_url('RentalCompany/managerent') ?>">Manage Rent</a></li>
        <li><a href="<?= base_url('RentalCompany/reports') ?>">Reports</a></li>
        <li><a href="<?= base_url('/logout') ?>">Logout</a></li>    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
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

    <!-- Tab Buttons -->
    <div class="tab-buttons">
        <button class="tab-btn active" onclick="showSection('approval-section', this)">Approve Rentals</button>
        <button class="tab-btn" onclick="showSection('damage-section', this)">Damaged/Unavailable Cars</button>
        <button class="tab-btn" onclick="showSection('tracking-section', this)">Track Cars</button>
    </div>

    <!-- Approve Rentals Section -->
    <div class="content-section active" id="approval-section">
    <h2>Approve or Reject Rentals</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Car Model</th>
                <th>Plate No</th>
                <th>Pickup Date</th>
                <th>Drop-off Date</th>
                <th>Pickup Location</th>
                <th>Drop-off Location</th>
                <th>Rental Price</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rentals as $rental): ?>
            <tr>
                <td><?= $rental['id'] ?></td>
                <td><?= $rental['car_model'] ?></td>
                <td><?= $rental['plate_no'] ?></td>
                <td><?= $rental['pickup_date'] ?></td>
                <td><?= $rental['dropoff_date'] ?></td>
                <td><?= $rental['pickup_location'] ?></td>
                <td><?= $rental['dropoff_location'] ?></td>
                <td>₱<?= number_format($rental['rental_price'], 2) ?></td>
                <td>₱<?= number_format($rental['total_price'], 2) ?></td>
                <td><span class="status-<?= strtolower($rental['status']) ?>"><?= $rental['status'] ?></span></td>
                <td>
                    <?php if($rental['status'] === 'pending'): ?>
                    <a href="<?= base_url('RentalCompany/approveRental/'.$rental['id']) ?>" 
                       class="approve-btn">✓ Approve</a>
                    <a href="<?= base_url('RentalCompany/rejectRental/'.$rental['id']) ?>" 
                       class="reject-btn">✗ Reject</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

   <!-- Damaged/Unavailable Cars Section -->
<div class="content-section" id="damage-section">
    <h2>Damaged or Unavailable Cars</h2>
    <table>
        <thead>
            <tr>
                <th>Car ID</th>
                <th>Car Model</th>
                <th>Status</th>
                <th>Damage Description</th> <!-- New column -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CAR005</td>
                <td>Toyota Corolla</td>
                <td><span class="status-damaged">Damaged</span></td>
                <td>Broken headlight, dented front bumper</td> <!-- Added damage details -->
            </tr>
            <tr>
                <td>CAR012</td>
                <td>Honda Civic</td>
                <td><span class="status-damaged">Damaged</span></td>
                <td>Scratched doors, engine overheating</td>
            </tr>
            <tr>
                <td>CAR018</td>
                <td>Ford Explorer</td>
                <td><span class="status-damaged">Unavailable</span></td>
                <td>Flat tire, battery issue</td>
            </tr>
        </tbody>
    </table>
</div>


   <!-- Track Rented Cars Section -->
<div class="content-section" id="tracking-section">
    <h2>Track Rented Cars</h2>
    <table>
        <thead>
            <tr>
                <th>Car Image</th>
                <th>Car Model</th>
                <th>Renter</th>
                <th>Pickup Date</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="<?= base_url('public/assets/images/mustang.jpg') ?>" width="100" alt="Mustang"></td>
                <td>Ford Mustang</td>
                <td>John Amoguis</td>
                <td>2025-03-15</td>
                <td>2025-03-20</td>
                <td><button class="track-btn" onclick="trackCar('Mustang')">📍 Track Location</button></td>
            </tr>
            <tr>
                <td><img src="<?= base_url('public/assets/images/camaro.jpg') ?>" width="100" alt="Camaro"></td>
                <td>Chevrolet Camaro</td>
                <td>Mia Zayas</td>
                <td>2025-03-18</td>
                <td>2025-03-25</td>
                <td><button class="track-btn" onclick="trackCar('Camaro')">📍 Track Location</button></td>
            </tr>
        </tbody>
    </table>

    <!-- Map Section -->
    <div id="map" style="height: 400px; width: 100%; margin-top: 20px; border-radius: 8px; display: none;"></div>
</div>

<script>
    function trackCar(carModel) {
        document.getElementById('map').style.display = 'block';
        alert("Tracking " + carModel + "'s location...");
        // Here you can add code to integrate Google Maps API for live tracking
    }
</script>

<script>
    function showSection(sectionId, clickedBtn) {
        document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
        document.getElementById(sectionId).classList.add('active');

        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        clickedBtn.classList.add('active');
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
            dropdown.classList.remove("show");
        }
    });
</script>

</body>
</html>
