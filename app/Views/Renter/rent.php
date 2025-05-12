<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renter Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background: url('<?= base_url("public/assets/images/car4.jpg") ?>');
            background-size: 1600px 1000px;
            background-repeat: no-repeat;
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

        .sidebar ul li.active {
            background: rgb(36, 105, 174);
            /* Full background color */
            color: white;
            font-weight: bold;
            border-left: none;
            /* Remove left border */
            border-radius: 5px;
            /* Optional: Round the edges */
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .content-section {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }



        .dashboard {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 97%;
            margin: auto;
        }

        .nav-bar-card {
            background: rgba(1, 69, 105, 0.74);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(36, 29, 29, 0.1);
        }

        .nav-bar-card h1 {
            margin: 0;
            font-size: 28px;
            color: black;
        }

        .table-container {
            overflow-x: auto;
        }

        .rented-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }

        .rented-table th,
        .rented-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            white-space: nowrap;
        }

        .rented-table th {
            background: #333;
            color: white;
        }

        .car-image {
            width: 60px;
            height: auto;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 10px;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .table-container {
                overflow-x: auto;
            }

            .rented-table {
                font-size: 12px;
            }

        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Renter Dashboard</h2>
        <ul>
            <li><a href="<?= base_url('renterpage') ?>">Homepage</a></li>
            <li><a href="<?= base_url('Renter/companycars') ?>">Company Cars</a></li>
            <li class="active"><a href="<?= base_url('Renter/rent') ?>">Renter</a></li>
            <li><a href="<?= base_url('Renter/profile') ?>">Profile</a></li>
            <li><a href="<?= base_url('/logout') ?>">Logout</a></li>
        </ul>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <!-- Nav Bar / Title Section -->
        <div class="nav-bar-card">
            <h1>Car Rental Management System</h1>
        </div>

        <div class="main-content">
            <div class="dashboard">
                <h2>Customer Renter Information</h2>
                <div class="table-container">
                    <table class="rented-table">
                        <tr>
                            <th>Company Rented</th>
                            <th>Car Model</th>
                            <th>Plate#</th>
                            <th>Pick-up Date</th>
                            <th>Pick-up Location</th>
                            <th>Drop-off Date</th>
                            <th>Drop-off Location</th>
                            <th>Rental Price</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($rentals as $rental): ?>

                            <tr>
                                <td><?= esc($rental['company_name']) ?></td>
                                <td><?= esc($rental['model']) ?></td>
                                <td><?= esc($rental['plate_no']) ?></td>
                                <td><?= esc($rental['pickup_date']) ?></td>
                                <td><?= esc($rental['pickup_location']) ?></td>
                                <td><?= esc($rental['dropoff_date']) ?></td>
                                <td><?= esc($rental['dropoff_location']) ?></td>
                                <td><?= esc($rental['rental_price']) ?></td>
                                <td><?= esc($rental['total_price']) ?></td>
                                <td><?= esc($rental['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            </div>

            <!-- Feedback Section -->
            <div class="content-section feedback-section">
                <h2>Customer Feedback</h2>
                <p>We value your feedback! Let us know about your rental experience.</p>
                <form action="<?= base_url('Renter/submitFeedback') ?>" method="POST">
                    <textarea name="feedback" rows="4" placeholder="Write your feedback here..." required style="width: 97%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;"></textarea>
                    <br>
                    <button type="submit" style="margin-top: 10px; background: #27ae60; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; transition: background 0.3s;">
                        Submit Feedback
                    </button>
                </form>
            </div>



        </div>

        <!-- JavaScript -->
        <script>
            function showSection(sectionId, clickedElement) {
                document.querySelectorAll('.sidebar ul li').forEach(li => li.classList.remove('active'));
                if (clickedElement) {
                    clickedElement.classList.add('active');
                }
                document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));
                document.getElementById(sectionId).classList.add('active');
            }
        </script>

</body>

</html>