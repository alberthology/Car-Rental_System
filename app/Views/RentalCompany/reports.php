<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Company Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bootstrap -->

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-qLsk5GvYqAAMzE3R9PZT6kBe/NvFvUovE+4SogKe0V1lZcZnDJNn1CqLxOZyV8B5" crossorigin="anonymous">


    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- jQuery (required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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


        .main-content {
            flex: 1;
            padding: 20px;
        }

        .dashboard {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 300px;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        .report-card {
            background: #fff;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 600px;
            margin: 20px auto;
            display: block;
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
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
            <li><a href="<?= base_url('RentalCompany/managerent') ?>">Manage Rent</a></li>
            <li class="active"><a href="<?= base_url('RentalCompany/reports') ?>">Reports</a></li>
            <li><a href="<?= base_url('/logout') ?>" id="logoutLink">Logout</a></li>

        </ul>
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

        <!-- 💰 Company Reports Section -->
        <div class="table-container">
            <h2 style="color: #3498db;">💰 Company Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Report Type</th>
                        <th>Amount (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data for Reports -->
                    <tr>
                        <td>Total Sales</td>
                        <td>₱1,200,000.00</td>
                    </tr>
                    <tr>
                        <td>Total Maintenance Cost</td>
                        <td>₱300,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- 🔧 Maintenance Reports Section -->
        <div class="table-container">
            <h2 style="color: #e74c3c;">🔧 Maintenance Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Maintenance Type</th>
                        <th>Cost (₱)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Maintenance Cost</td>
                        <td>₱300,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
    </div>

    <script>
        // swal config - Roy 
        document.getElementById('logoutLink').addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Notice',
                text: "You are about to log out.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {

                    // window.location.href = this.href;
                    window.location.href = "<?= base_url('/logout') ?>";
                }
            });
        });

        // Toastr configuration - ROY

        <?php if (session()->getFlashdata('toastr_info')) :
            $messages = session()->getFlashdata('toastr_info');
            if (is_array($messages)) :
                foreach ($messages as $msg) : ?>
                    toastr.success("<?= esc($msg) ?>");
                <?php endforeach;
            else : ?>
                toastr.success("<?= esc($messages) ?>");
        <?php endif;
        endif; ?>

        <?php if (session()->getFlashdata('toastr_success')) : ?>
            setTimeout(function() {
                toastr.info("<?= esc(session()->getFlashdata('toastr_success')) ?>");
            }, 1000);
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            toastr.error("<?= session()->getFlashdata('error') ?>");
        <?php endif; ?>

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
                dropdown.classList.remove('show');
            }
        });
    </script>

</body>

</html>