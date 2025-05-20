<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renter Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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
            <li><a href="<?= base_url('/logout') ?>" id="logoutLink">Logout</a></li>

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
                <!-- <div class=""> -->
                <table id="companyTable">
                    <thead>

                        <tr>
                            <th>No.</th>
                            <th>Company Rented</th>
                            <th>Car Rented</th>
                            <th>Plate#</th>
                            <!--<th>Pick-up Date</th>
                            <th>Pick-up Location</th>
                            <th>Drop-off Date</th>
                            <th>Drop-off Location</th>
                            <th>Rental Price</th>
                            <th>Total Price</th> -->
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($rentals as $rental): ?>

                            <tr>
                                <td><?php echo $no++; ?></td>

                                <td><?= esc($rental['company_name']) ?></td>
                                <td><?= esc($rental['brand']) ?> <?= esc($rental['model']) ?></td>
                                <td><?= esc($rental['plate_no']) ?></td>
                                <td><span class=""><?= esc($rental['status']) ?></span></td>
                                <td>
                                    <button
                                        type="button"
                                        class="btn btn-secondary view-details-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detailsModal"

                                        data-company="<?= esc($rental['company_name']) ?>"
                                        data-model="<?= esc($rental['model']) ?>"
                                        data-brand="<?= esc($rental['brand']) ?>"
                                        data-plate="<?= esc($rental['plate_no']) ?>"

                                        data-pickup_date="<?= esc((new DateTime($rental['pickup_date']))->format('F j, Y')) ?>"
                                        data-dropoff_date="<?= esc((new DateTime($rental['dropoff_date']))->format('F j, Y')) ?>"
                                        data-rental_price="<?= number_format($rental['rental_price'], 2) ?>"
                                        data-total_price="<?= number_format($rental['total_price'], 2) ?>"

                                        data-status="<?= esc($rental['status']) ?>"
                                        data-address="<?= esc($rental['address']) ?>">
                                        View Details
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <!-- </div> -->
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

        <!-- Modal -->
        <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="detailsModalLabel">Rental Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">

                                <label class="fw-bold">Company Rented:</label>
                                <p><span id="modalCompany"></span></p>


                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Company Address:</label>
                                <p> <span id="modalAddress"></span></p>

                            </div>
                        </div>
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
                                <label class="fw-bold">Return date:</label>
                                <p> <span id="modalDropoff_date"></span></p>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-6">
                                <label class="fw-bold">Pick-up location:</label>
                                <p><span id="modalPickup_location"></span> <span id="modalModel"></span></p>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Drop-off location:</label>
                                <p><span id="modalDropoff_location"></span></p>
                            </div>
                        </div> -->
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- JavaScript -->
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
                        document.getElementById('modalCompany').textContent = button.getAttribute('data-company');
                        document.getElementById('modalAddress').textContent = button.getAttribute('data-address');
                        document.getElementById('modalBrand').textContent = button.getAttribute('data-brand');
                        document.getElementById('modalModel').textContent = button.getAttribute('data-model');
                        document.getElementById('modalPlate').textContent = button.getAttribute('data-plate');

                        document.getElementById('modalPickup_date').textContent = button.getAttribute('data-pickup_date');
                        // document.getElementById('modalPickup_location').textContent = button.getAttribute('data-pickup_location');
                        document.getElementById('modalDropoff_date').textContent = button.getAttribute('data-dropoff_date');
                        // document.getElementById('modalDropoff_location').textContent = button.getAttribute('data-dropoff_location');
                        document.getElementById('modalRental_price').textContent = button.getAttribute('data-rental_price');
                        document.getElementById('modalTotal_price').textContent = button.getAttribute('data-total_price');

                        document.getElementById('modalStatus').textContent = button.getAttribute('data-status');
                    });
                });
            });


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