<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Company Dashboard</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-qLsk5GvYqAAMzE3R9PZT6kBe/NvFvUovE+4SogKe0V1lZcZnDJNn1CqLxOZyV8B5" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-B41KcXwi0PqE+i4V0L5LLQh+AxGoTpaWy4MwUX4hPUIaU4V1YkG8nA5bK0Enj5It" crossorigin="anonymous"></script>

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
            background: url('<?= base_url("public/assets/images/car4.jpg") ?>') no-repeat center center/cover;
        }

        /* Sidebar */
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

        /* Main Content */
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

        /* Dashboard Grid */
        .dashboard-grid {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .dashboard-card {
            background: rgba(10, 67, 98, 0.74);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            min-width: 200px;
            transition: transform 0.3s, background 0.3s;
            cursor: pointer;
        }

        .dashboard-card:hover {
            transform: scale(1.05);
            background: rgba(15, 90, 130, 0.9);
        }

        .notification-icon {
            font-size: 25px;
            cursor: pointer;
        }

        .notification-icon span {
            font-size: 12px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: rgba(197, 2, 2, 0.74);
            color: white;
        }

        /* Add Car Button */
        .add-car {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .add-car:hover {
            background: #219150;
        }

        /* Modal Styling */
        .modal {
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
            width: 70%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close-btn {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .close-btn:hover {
            background: #1a252f;
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

        .show {
            display: block;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Rental Company Dashboard</h2>
        <ul>
            <li class="active"><a href="<?= base_url('RentalCompany/company') ?>">Homepage</a></li>
            <li><a href="<?= base_url('RentalCompany/managecars') ?>">Manage Cars</a></li>
            <li><a href="<?= base_url('RentalCompany/managerent') ?>">Manage Rent</a></li>
            <li><a href="<?= base_url('RentalCompany/reports') ?>">Reports</a></li>
            <li><a href="<?= base_url('/logout') ?>" id="logoutLink">Logout</a></li>

        </ul>
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

        <div class="dashboard-grid">
            <div class="dashboard-card">🚗 Total Rented Cars (<?= $rentedCount ?>)</div>
            <div class="dashboard-card">🛠️ Damaged Cars (<?= $damagedCount ?>)</div>
            <div class="dashboard-card">🔔 Unavailable Cars (<?= $unavailableCount ?>)</div>
            <div class="dashboard-card">✅ Available Cars (<?= $availableCount ?>)</div>

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



        // current script

        // Toggle dropdown visibility
        function toggleNotifications() {
            var dropdown = document.getElementById("notificationDropdown");
            dropdown.classList.toggle("show");
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var dropdown = document.getElementById("notificationDropdown");
            var bell = document.querySelector('.notification-bell');

            if (!bell.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    </script>

</body>

</html>