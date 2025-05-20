<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Company Dashboard</title>
    <!-- jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Then toastr (depends on jQuery) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Then Bootstrap (no longer needs jQuery in v5, but must come after it if others do) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Then other libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">



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

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #2c3e50;
            color: white;
        }

        .approve-btn {
            background: #27ae60;
        }

        .reject-btn {
            background: #c0392b;
        }

        .track-btn {
            background: #3498db;
        }

        .status-pending {
            color: #f39c12;
            font-weight: bold;
        }

        .status-approved {
            color: #27ae60;
            font-weight: bold;
        }

        .status-rejected {
            color: #c0392b;
            font-weight: bold;
        }

        .status-damaged {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-unavailable {
            color: #95a5a6;
            font-weight: bold;
        }

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
            <li class="active"><a href="<?= base_url('RentalCompany/managerent') ?>">Manage Rent</a></li>
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

        <!-- Tab Buttons -->
        <div class="tab-buttons">
            <button class="tab-btn active" onclick="showSection('approval-section', this)">Approve Rentals</button>
            <button class="tab-btn" onclick="showSection('damage-section', this)">Damaged/Unavailable Cars</button>
            <button class="tab-btn" onclick="showSection('tracking-section', this)">Track Cars</button>
        </div>

        <!-- Approve Rentals Section -->
        <div class="content-section active" id="approval-section">
            <h2>Rented Cars</h2>
            <table id="companyTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Car Model</th>
                        <th>Plate No</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($rentals as $rental): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?= $rental['brand'] ?> <?= $rental['model'] ?></td>
                            <td><?= $rental['plate_no'] ?></td>
                            <td><span class="status-<?= strtolower($rental['status']) ?>"><?= $rental['status'] ?></span></td>
                            <td>
                                <?php if ($rental['status'] === 'pending'): ?>
                                    <a href="<?= base_url('RentalCompany/approveRental/' . $rental['id']) ?>"
                                        class="approve-btn">✓ Approve</a>
                                    <a href="<?= base_url('RentalCompany/rejectRental/' . $rental['id']) ?>"
                                        class="reject-btn">✗ Reject</a>
                                <?php endif; ?>


                                <button
                                    type="button"
                                    class="btn btn-primary view-details-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailsModal"

                                    data-rental_id="<?= esc($rental['rental_id']) ?>"
                                    data-car_id="<?= esc($rental['car_id']) ?>"

                                    data-renter_id="<?= esc($rental['renter_id']) ?>"
                                    data-user_id="<?= esc($rental['user_id']) ?>"
                                    data-name="<?= esc($rental['name']) ?>"
                                    data-birthdate="<?= esc($rental['birthdate']) ?>"
                                    data-gender="<?= esc($rental['gender']) ?>"
                                    data-phone="<?= esc($rental['phone']) ?>"
                                    data-address="<?= esc($rental['address']) ?>"
                                    data-license_no="<?= esc($rental['license_no']) ?>"

                                    data-model="<?= esc($rental['model']) ?>"
                                    data-brand="<?= esc($rental['brand']) ?>"
                                    data-plate="<?= esc($rental['plate_no']) ?>"

                                    data-pickup_date="<?= esc((new DateTime($rental['pickup_date']))->format('F j, Y')) ?>"
                                    data-edit_dropoff_date="<?= esc($rental['dropoff_date']) ?>"
                                    data-dropoff_date="<?= esc((new DateTime($rental['dropoff_date']))->format('F j, Y')) ?>"


                                    data-rental_price="<?= number_format($rental['rental_price'], 2) ?>"
                                    data-total_price="<?= number_format($rental['total_price'], 2) ?>"
                                    data-status="<?= esc($rental['status']) ?>">
                                    View Details
                                </button>

                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#trackModal">
                                    Track Location & Speed
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-success return-car-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#returnCarModal"
                                    data-rental_id="<?= esc($rental['rental_id']) ?>"
                                    data-car_id="<?= esc($rental['car_id']) ?>">
                                    Return Car
                                </button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <!-- details Modal -->
        <div class="modal fade modal-lg" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Rent Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">

                                <label class="fw-bold">Renter:</label>
                                <p><span id="modalRenter"></span></p>


                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Address:</label>
                                <p> <span id="modalAddress"></span></p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <label class="fw-bold">Gender:</label>
                                <p><span id="modalGender"></span></p>


                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Phone:</label>
                                <p> <span id="modalPhone"></span></p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <label class="fw-bold">Birthdate:</label>
                                <p><span id="modalBirthdate"></span></p>


                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">License Number:</label>
                                <p> <span id="modalLicense"></span></p>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Car Rented:</label>
                                <p><span id="modalBrand"></span> <span id="modalModel"></span></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Plate No:</label>
                                <p> <span id="modalPlate"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Pick-up date:</label>
                                <p> <span id="modalPickup_date"></span> <span id="modalModel"></span></p>
                            </div>
                            <div class="col-md-6">

                                <label class="fw-bold">Return date:</label><br>
                                <div id="returnDateDisplay">
                                    <p> <span id="modalDropoff_date"></span></p>
                                </div>
                                <form id="updateForm" style="display: none;">
                                    <input type="date" id="modalEditDropoff_date">
                                    <input type="hidden" id="modalRentalId">
                                    <button type="submit" class="btn btn-primary">Update Date</button>
                                    <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Rental Cost per day:</label>
                                <p>₱<span id="modalRental_price"></span> <span id="modalModel"></span></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Total Cost:</label>
                                <p>₱<span id="modalTotal_price"></span></p>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-md-6"></div> -->
                            <div class="col-md-12">
                                <label class="fw-bold">Status:</label>
                                <p><span id="modalStatus"></span></p>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updateBtn">Update Return Date</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- Tracking Car location and speed Modal -->
        <div class="modal fade modal-lg" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="trackModalLabel">Track Location & Speed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- modal content -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert">
                                    <strong>Note:</strong> This feature is currently work in progress.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!--  buttons  -->
                    </div>
                </div>
            </div>
        </div>


        <!-- Return Car Modal -->
        <div class="modal fade" id="returnCarModal" tabindex="-1" aria-labelledby="returnCarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="returnCarForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Return Car</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Hidden Fields -->
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrf_token">

                            <input type="hidden" id="returnCarId" name="car_id">
                            <input type="hidden" id="returnRentalId" name="rental_id">

                            <!-- Select Car Status -->
                            <div class="mb-3">
                                <label for="carStatus" class="form-label">Car Condition</label>
                                <select class="form-select" id="carStatus" name="car_status" required>
                                    <option value="" selected disabled hidden>Select status</option>
                                    <option value="Available">Good Condition</option>
                                    <option value="Damaged">Damaged</option>
                                    <option value="Unavailable">Need Maintenance</option>
                                </select>
                            </div>

                            <!-- If Damaged, show extra fields -->
                            <div id="damageFields" style="display: none;">
                                <div class="mb-3">
                                    <label for="damageDescription" class="form-label">Damage Description</label>
                                    <textarea class="form-control" id="damageDescription" name="description" rows="3"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="repairCost" class="form-label">Estimated Repair Cost (₱)</label>
                                    <input type="number" step="0.01" class="form-control" id="repairCost" name="estimated_repair_cost">
                                </div>

                                <div class="mb-3">
                                    <label for="damageDate" class="form-label">Damage Date</label>
                                    <input type="date" class="form-control" id="damageDate" name="damage_date" value="<?= date('Y-m-d') ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="damagePhoto" class="form-label">Damage Photo (optional)</label>
                                    <input type="file" class="form-control" id="damagePhoto" name="photo">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Confirm Return</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Damaged/Unavailable Cars Section -->
        <div class="content-section" id="damage-section">
            <h2>Damaged or Unavailable Cars</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Car Model</th>
                        <th>Status</th>
                        <th>Damage Description</th> <!-- New column -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($damageReports as $damageReport): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($damageReport['brand'] ?? '') . ' ' . esc($damageReport['model'] ?? '') ?></td>
                            <td>
                                <span class="status-<?= strtolower($damageReport['status']) ?>">
                                    <?= esc($damageReport['status']) ?>
                                </span>
                            </td>
                            <td><?= esc($damageReport['description'] ?? $damageReport['damage_description'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
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

            // DataTable initialization
            $(document).ready(function() {
                $('#companyTable').DataTable({
                    pageLength: 5
                });
            });


            // Modal functionality
            // Initialize the modal when the document is ready
            document.addEventListener('DOMContentLoaded', function() {
                const detailButtons = document.querySelectorAll('.view-details-btn');

                detailButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        document.getElementById('modalBrand').textContent = button.getAttribute('data-brand');
                        document.getElementById('modalModel').textContent = button.getAttribute('data-model');
                        document.getElementById('modalPlate').textContent = button.getAttribute('data-plate');

                        document.getElementById('modalRenter').textContent = button.getAttribute('data-name');
                        document.getElementById('modalAddress').textContent = button.getAttribute('data-address');
                        document.getElementById('modalGender').textContent = button.getAttribute('data-gender');
                        document.getElementById('modalPhone').textContent = button.getAttribute('data-phone');
                        document.getElementById('modalBirthdate').textContent = button.getAttribute('data-birthdate');
                        document.getElementById('modalLicense').textContent = button.getAttribute('data-license_no');
                        // document.getElementById('modalUser_id').textContent = button.getAttribute('data-user_id');

                        document.getElementById('modalPickup_date').textContent = button.getAttribute('data-pickup_date');
                        document.getElementById('modalEditDropoff_date').value = button.getAttribute('data-edit_dropoff_date');
                        document.getElementById('modalDropoff_date').textContent = button.getAttribute('data-dropoff_date');
                        document.getElementById('modalRental_price').textContent = button.getAttribute('data-rental_price');
                        document.getElementById('modalTotal_price').textContent = button.getAttribute('data-total_price');

                        document.getElementById('modalStatus').textContent = button.getAttribute('data-status');
                        document.getElementById('modalRentalId').value = button.getAttribute('data-rental_id');
                    });
                });




                const returnCarButtons = document.querySelectorAll('.return-car-btn');

                returnCarButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Get the rental ID and car ID from the button's data attributes

                        // document.getElementById('modalStatus').textContent = button.getAttribute('data-status');
                        document.getElementById('returnRentalId').value = button.getAttribute('data-rental_id');
                        document.getElementById('returnCarId').value = button.getAttribute('data-car_id');
                    });
                });
            });

            document.getElementById('carStatus').addEventListener('change', function() {
                const damageFields = document.getElementById('damageFields');
                damageFields.style.display = this.value === 'Damaged' ? 'block' : 'none';
            });


            // Update return date functionality
            document.getElementById("updateBtn").addEventListener("click", function() {
                // Show the form
                document.getElementById("updateForm").style.display = "block";

                // Hide the return date display
                document.getElementById("returnDateDisplay").style.display = "none";

                // Hides button
                document.getElementById("updateBtn").style.display = "none";
            });


            document.getElementById("cancelBtn").addEventListener("click", function() {
                // Reset to initial view
                document.getElementById("updateForm").style.display = "none";
                document.getElementById("returnDateDisplay").style.display = "block";
                document.getElementById("updateBtn").style.display = "inline-block"; // or 'block' based on your layout

                // Optional: Clear the date input
                // document.getElementById("modalEditDropoff_date").value = "";
            });



            document.getElementById("updateForm").addEventListener("submit", function(e) {
                e.preventDefault();

                const rentalId = document.getElementById("modalRentalId").value;
                const newDropoffDate = document.getElementById("modalEditDropoff_date").value;

                if (!newDropoffDate) {
                    toastr.error("Please select a new return date.");
                    return;
                }

                fetch("<?= base_url('RentalCompany/updateDropoffDate') ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": "<?= csrf_hash() ?>"

                        },
                        body: JSON.stringify({
                            rental_id: rentalId,
                            dropoff_date: newDropoffDate
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('AJAX response:', data); // Add this line

                            setTimeout(function() {
                                toastr.success("Return date updated!");
                            }, 100); // Small delay
                            // Update modal display
                            document.getElementById("modalDropoff_date").textContent = new Date(newDropoffDate).toLocaleDateString();
                            document.getElementById("updateForm").style.display = "none";
                            document.getElementById("returnDateDisplay").style.display = "block";
                            document.getElementById("updateBtn").style.display = "inline-block";

                            // Update the table row's return date (if you have a cell for it)
                            // Find the button with the matching rental_id
                            const allDetailBtns = document.querySelectorAll('.view-details-btn');
                            allDetailBtns.forEach(btn => {
                                if (btn.getAttribute('data-rental_id') === rentalId) {
                                    // Find the row
                                    const row = btn.closest('tr');
                                    if (row) {

                                        btn.setAttribute('data-dropoff_date', new Date(newDropoffDate).toLocaleDateString());
                                    }
                                }
                            });
                        } else {
                            toastr.error(data.message || "Update failed.");
                        }
                    })
                    .catch(() => toastr.error("Server error. Please try again."));
            });


            document.getElementById("returnCarForm").addEventListener("submit", function(e) {
                e.preventDefault();

                const form = e.target;
                const formData = new FormData();

                const return_rentalId = document.getElementById("returnRentalId").value;
                const return_carId = document.getElementById("returnCarId").value;
                const carStatus = document.getElementById("carStatus").value;

                formData.append("rental_id", return_rentalId);
                formData.append("car_id", return_carId);
                formData.append("car_status", carStatus);
                formData.append("<?= csrf_token() ?>", document.getElementById("csrf_token").value);

                if (carStatus === "Damaged") {
                    const damageDescription = document.getElementById("damageDescription").value;
                    const repairCost = document.getElementById("repairCost").value;
                    const damageDate = document.getElementById("damageDate").value;
                    const damagePhoto = document.getElementById("damagePhoto").files[0];

                    if (!damageDescription || !repairCost || !damageDate || !damagePhoto) {
                        toastr.error("Please fill in all damage details.");
                        return;
                    }

                    formData.append("description", damageDescription);
                    formData.append("estimated_repair_cost", repairCost);
                    formData.append("damage_date", damageDate);
                    formData.append("photo", damagePhoto);
                }

                fetch("<?= base_url('RentalCompany/returnCar') ?>", {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": "<?= csrf_hash() ?>"
                        },
                        body: formData
                    })
                    .then(response => {
                        // Check if response is JSON
                        const contentType = response.headers.get("content-type");
                        if (contentType && contentType.indexOf("application/json") !== -1) {
                            return response.json();
                        } else {
                            throw new Error("Not JSON");
                        }
                    })
                    .then(data => {
                        if (data.success) {
                            toastr.success(data.message || "Car returned successfully!");
                            // Close modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('returnCarModal'));
                            if (modal) modal.hide();
                            // Optionally reload page or update table
                            setTimeout(() => location.reload(), 1200);
                        } else {
                            toastr.error(data.message || "Failed to return car.");
                        }
                    })
                    .catch((err) => {
                        toastr.error("Server error. Please try again.");
                        console.error(err);
                    });
            });



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