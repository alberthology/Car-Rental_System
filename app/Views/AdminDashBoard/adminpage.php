<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            margin-bottom: 20px;
        }

        .dashboard-grid {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .dashboard-card {
            flex: 1;
            background: rgba(10, 67, 98, 0.74);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            min-width: 200px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .dashboard-card:hover {
            transform: scale(1.05);
            background: rgba(10, 67, 98, 0.9);
        }
        
        .dashboard-card h3 {
            margin: 0 0 10px 0;
        }
        
        .dashboard-card p {
            margin: 0;
            font-size: 14px;
            opacity: 0.8;
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
            background: #34495e;
            color: white;
        }
        .approve-btn, .decline-btn {
            padding: 8px 12px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            margin: 0 5px;
            margin-top: 30px;
           
        }

        .approve-btn {
            background: #27ae60;
            
        }
        .decline-btn {
            background: #c0392b;
            margin-left: 100px;
            
        }
        .content-section {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .content-section.active {
            display: block;
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
        .sidebar ul li.active {
            background: rgb(36, 105, 174);
            color: white;
            font-weight: bold;
            border-left: none;
            border-radius: 5px;
        }
        .sidebar h2 {
            font-weight: bold;
            margin: 0 0 30px 0;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li onclick="showSection('dashboard', this)" class="active">Homepage</li>
            <li onclick="showSection('cars-table', this)">Manage Rental</li>
            <li onclick="showSection('renters-table', this)">Manage Renter</li>
            <li><a href="<?= base_url('/logout') ?>">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="nav-bar-card">
            <h1>Car Rental Management System</h1>
        </div>

        <!-- Homepage Section -->
        <div id="dashboard" class="content-section active">
            <div class="dashboard-grid">
                <div class="dashboard-card" onclick="showSection('cars-table', document.querySelector('.sidebar ul li:nth-child(2)'))">
                    <h3>Request Company Rental (30)</h3>
                    <p>Click to view requests</p>
                </div>
                <div class="dashboard-card" onclick="showApprovedSection()">
                    <h3>Approved Company Rental (25)</h3>
                    <p>Click to view approved companies</p>
                </div>
            </div>
            
            <div class="content-section">
                <h2>Pending Company Approvals</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pending_companies ?? [] as $company): ?>
                        <tr>
                            <td><?= esc($company['company_name']) ?></td>
                            <td><?= esc($company['email']) ?></td>
                            <td><?= esc($company['status']) ?></td>
                            <td>
                                <a href="<?= base_url('admin/approve/' . $company['company_id']) ?>" 
                                   class="approve-btn">Approve</a>
                                <a href="<?= base_url('admin/decline/' . $company['company_id']) ?>" 
                                   class="decline-btn">Decline</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manage Rental Section -->
        <div id="cars-table" class="content-section">
            <!-- <div class="dashboard-grid">
                <div class="dashboard-card">Pending Rentals</div>
                <div class="dashboard-card">Approved Rentals</div>
            </div> -->
            <div class="table-container">
                <h3>List of Request Company Rental</h3>
                <table>
                    <tr>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>Year</th>
                        <th>Email</th>
                        <th>Request Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($pending_companies ?? [] as $company): ?>
                    <tr>
                        <td><?= esc($company['company_id']) ?></td>
                        <td><?= esc($company['company_name']) ?></td>
                        <td><?= esc($company['address']) ?></td>
                        <td><?= esc($company['year_established']) ?></td>
                        <td><?= esc($company['email']) ?></td>
                        <td><?= esc($company['status']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/approve/' . $company['company_id']) ?>" 
                               class="approve-btn">Approve</a>
                            <a href="<?= base_url('admin/decline/' . $company['company_id']) ?>" 
                               class="decline-btn">Decline</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

                <h3 style="margin-top: 30px;">List of Approved Company Rental</h3>
                <table>
                    <tr>
                        <th>Company ID</th>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>Year</th>
                        <th>Email</th>
                        <th>Account Status</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($approved_companies ?? [] as $company): ?>
                    <tr>
                        <td><?= esc($company['company_id']) ?></td>
                        <td><?= esc($company['company_name']) ?></td>
                        <td><?= esc($company['address']) ?></td>
                        <td><?= esc($company['year_established']) ?></td>
                        <td><?= esc($company['email']) ?></td>
                        <td><span style="color: #27ae60; font-weight: bold;"><?= esc($company['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <!-- Manage Renters Section -->
        <div id="renters-table" class="content-section">
            <div class="table-container">
                <h3>List of Request Renters</h3>
                <table>
                    <tr>
                        <th>Renter ID</th>
                        <th>Renter Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Drivers License</th>
                        <th>Request Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($pending_renters ?? [] as $renter): ?>
                    <tr>
                        <td><?= esc($renter['renter_id']) ?></td>
                        <td><?= esc($renter['name']) ?></td>
                        <td><?= esc($renter['email']) ?></td>
                        <td><?= esc($renter['phone']) ?></td>
                        <td><?= esc($renter['address']) ?></td>
                        <td><?= esc($renter['birthdate']) ?></td>
                        <td><?= esc($renter['gender']) ?></td>
                        <td><?= esc($renter['license_no']) ?></td>
                        <td><?= esc($renter['status']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/approve/renter/' . $renter['renter_id']) ?>" 
                               class="approve-btn">Approve</a>
                            <a href="<?= base_url('admin/decline/renter/' . $renter['renter_id']) ?>" 
                               class="decline-btn">Decline</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <br><br>
            <div class="table-container">
                <h3>List of Approved Renters</h3>
                <table>
                    <tr>
                        <th>Renter ID</th>
                        <th>Renter Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Drivers License</th>
                        <th>Renter Status</th>
                    </tr>
                    <?php foreach ($approved_renters ?? [] as $renter): ?>
                    <tr>
                        <td><?= esc($renter['renter_id']) ?></td>
                        <td><?= esc($renter['name']) ?></td>
                        <td><?= esc($renter['email']) ?></td>
                        <td><?= esc($renter['phone']) ?></td>
                        <td><?= esc($renter['address']) ?></td>
                        <td><?= esc($renter['birthdate']) ?></td>
                        <td><?= esc($renter['gender']) ?></td>
                        <td><?= esc($renter['license_no']) ?></td>
                        <td><span style="color: #27ae60; font-weight: bold;"><?= esc($renter['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showSection(sectionId, clickedElement) {
            // Remove active class from all list items
            document.querySelectorAll('.sidebar ul li').forEach(li => {
                li.classList.remove('active');
            });

            // Add active class to clicked element
            if (clickedElement) {
                clickedElement.classList.add('active');
            }

            // Hide all content sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionId).classList.add('active');
        }

        function showApprovedSection() {
            // Show cars-table section
            showSection('cars-table', document.querySelector('.sidebar ul li:nth-child(2)'));
            
            // Scroll to the approved companies table
            document.querySelector('h3[style="margin-top: 30px;"]').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>