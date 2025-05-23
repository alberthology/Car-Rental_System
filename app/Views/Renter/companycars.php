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
            background: url('<?= base_url("public/assets/images/car4.jpg") ?>') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #34495e;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            width: 100%;
            height: 100%;
        }

        .sidebar ul li:hover {
            background: #34495e;
        }

        .sidebar ul li.active {
            background: rgb(36, 105, 174);
            color: white;
            border-left: none;
            /* Remove left border */
            font-weight: bold;
            border-radius: 5px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            /* Match sidebar width */
            width: calc(100% - 250px);
        }

        .sidebar h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 30px 0;
        }


        .dashboard {
            background: white;
            padding: 15px;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 1100px;
            margin-left: 40px;
        }

        .nav-bar-card {
            background: rgba(1, 69, 105, 0.74);
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-bar-card h1 {
            margin: 0;
            font-size: 28px;
            color: black;

        }


        /* Custom styles for Bootstrap tabs */
        .nav-tabs .nav-link {
            background: rgb(204, 201, 201);
            border-color: invert;
            /* Default tab background */
            color: black;
            /* Default text color */
            /* border-radius: 5px; */
        }

        .nav-tabs .nav-link.active {
            background: rgb(36, 105, 174) !important;
            border-color: rgb(36, 105, 174);

            /* Active tab background */
            font-weight: bold;
            color: white !important;
        }

        /* Tab content styling */
        .tab-content {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            /* margin-top: 10px; */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            background: #2c3e50;
            padding: 10px;
            border-radius: 8px;
        }

        .tab {
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            background: #34495e;
        }

        .car-list {
            display: flex;
            flex-wrap: nowrap;
            gap: 20px;
            overflow-x: auto;
            overflow-y: hidden;
            width: 100%;
            /* or a specific width if needed */
        }


        .car {
            text-align: center;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .car img {
            width: 200px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- Sidebar HTML -->
    <div class="sidebar">
        <h2>Renter Dashboard</h2>
        <ul>
            <li><a href="<?= base_url('renterpage') ?>">Homepage</a></li>
            <li class="active"><a href="<?= base_url('Renter/companycars') ?>">Company Cars</a></li>
            <li><a href="<?= base_url('Renter/rent') ?>">Renter</a></li>
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

        <div class="container">
            <!-- Bootstrap Navigation Tabs -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-europcar-tab" data-bs-toggle="tab" data-bs-target="#nav-europcar" type="button" role="tab">Car Companies</button>
                    <?php foreach ($companies as $company): ?>
                        <button class="nav-link" id="nav-tab<?= esc($company['company_id']) ?>-tab"
                            data-bs-toggle="tab" data-bs-target="#nav-tab<?= esc($company['company_id']) ?>"
                            type="button" role="tab">
                            <?= esc($company['company_name']) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </nav>

            <!-- Tab Content -->
            <div class="tab-content" id="nav-tabContent">
                <div id="rentSuccessAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Successfully Rented!</strong> Your rental and payment info was submitted.
                    <button type="button" class="btn-close" onclick="hideSuccessAlert()" aria-label="Close"></button>
                </div>
                <?php foreach ($companies as $company): ?>
                    <div class="tab-pane fade" id="nav-tab<?= esc($company['company_id']) ?>" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Available Cars for <?= esc($company['company_name']) ?></h2>
                                <div class="car-list">

                                    <!-- Loop through $cars and filter by company_id -->
                                    <?php foreach ($cars as $car): ?>
                                        <?php if ($car['company_id'] == $company['company_id']): ?>
                                            <div class="car">

                                                <!-- car image for each row --->
                                                <?php if (isset($photosByCarId[$car['car_id']])): ?>
                                                    <?php $firstPhoto = $photosByCarId[$car['car_id']][0]; ?>
                                                    <img src="<?= base_url($firstPhoto['photo_path']) ?>" alt="<?= esc($car['model']) ?>" style="width: 200px; height: auto;">
                                                <?php else: ?>
                                                    <img src="<?= base_url('images/no-image.png') ?>" alt="No Image" style="width: 200px; height: auto;">
                                                <?php endif; ?>

                                                <p>Model: <?= esc($car['model']) ?></p>
                                                <p>Brand: <?= esc($car['brand']) ?></p>
                                                <p>Year: <?= esc($car['year']) ?></p>
                                                <p>Status: <?= esc($car['status']) ?></p>
                                                <button class="btn btn-primary"
                                                    onclick="openRentModal('<?= esc($car['brand']) ?> <?= esc($car['model']) ?>', <?= esc($car['car_id']) ?>, <?= esc($car['price_per_day']) ?>, '<?= isset($photosByCarId[$car['car_id']]) ? base_url($photosByCarId[$car['car_id']][0]['photo_path']) : base_url('images/no-image.png') ?>')">
                                                    Rent Now
                                                </button>

                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

                <!-- Europcar -->
                <div class="tab-pane fade show active" id="nav-europcar" role="tabpanel">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h4>Available Companies</h4>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table id="companyTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Year Established</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($companies as $company): ?>
                                        <tr>
                                            <td><?= esc($company['company_name']) ?></td>
                                            <td><?= esc($company['address']) ?></td>
                                            <td><?= esc($company['year_established']) ?></td>
                                            <td><button
                                                    class="btn btn-secondary"
                                                    onclick="activateTab('nav-tab<?= esc($company['company_id']) ?>-tab')">
                                                    View
                                                </button>



                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Rent Modal -->
    <div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Made modal wider -->
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="rentModalLabel">Rent & Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rentForm">
                        <!-- Hidden values -->
                        <input type="hidden" id="carName">
                        <input type="hidden" id="car_id">
                        <input type="hidden" id="carPrice">

                        <!-- Car preview -->
                        <div class="d-flex gap-4 align-items-center mb-3">
                            <img id="carImage" src="" alt="Car Image" style="width: 150px; border-radius: 10px;">
                            <div>
                                <h5 id="modalCarName" class="mb-1"></h5>
                                <p class="mb-0">Rate: ₱<span id="modalCarRate"></span>/day</p>
                            </div>
                        </div>

                        <!-- Rental Dates -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pick-up Date</label>
                                <input type="date" id="rentStartDate" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Return Date</label>
                                <input type="date" id="rentEndDate" class="form-control" required>
                            </div>
                        </div>

                        <!-- Meetup location-->
                        <!-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pick-up location</label>
                                <input type="text" id="pickupLocation" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Drop-off location</label>
                                <input type="text" id="dropoffLocation" class="form-control" required>
                            </div>
                        </div> -->

                        <!-- Summary -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Days</label>
                                <input type="number" id="totalDays" class="form-control" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Total Cost (₱)</label>
                                <input type="text" id="totalCost" class="form-control" disabled>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-3">
                            <!-- <label class="form-label">Payment Method</label> -->
                            <select id="paymentMethod" class="form-select" required>
                                <option value="" selected hidden disabled>Choose Payment Method</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="gcash">GCash</option>
                                <option value="card">Credit/Debit Card</option>
                            </select>
                        </div>

                        <!-- GCash/Reference No (optional field depending on method) -->
                        <div class="mb-3" id="paymentReferenceContainer" style="display: none;">
                            <label class="form-label">Reference Number</label>
                            <input type="text" id="paymentReference" class="form-control" placeholder="e.g. GCash Ref No or Card Txn ID">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Confirm Rent</button>
                    </form>
                </div>
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

        // DataTable initialization
        $(document).ready(function() {
            $('#companyTable').DataTable();
        });


        function activateTab(tabId) {
            const tabTrigger = document.getElementById(tabId);
            if (tabTrigger) {
                const tab = new bootstrap.Tab(tabTrigger);
                tab.show();
            }
        }

        function openRentModal(carName, carId, pricePerDay, carImageUrl) {
            // hidden values
            document.getElementById('carName').value = carName;
            document.getElementById('car_id').value = carId;
            document.getElementById('carPrice').value = pricePerDay;
            // Update modal content
            document.getElementById('modalCarName').innerText = carName;
            document.getElementById('modalCarRate').innerText = pricePerDay;

            // ✅ Set the image
            document.getElementById('carImage').src = carImageUrl;

            // Reset fields
            document.getElementById('rentStartDate').value = "";
            document.getElementById('rentEndDate').value = "";

            /* document.getElementById('pickupLocation').value = "";
            document.getElementById('dropoffLocation').value = ""; */

            document.getElementById('totalDays').value = "";
            document.getElementById('totalCost').value = "";
            document.getElementById('paymentMethod').value = "";
            document.getElementById('paymentReference').value = "";
            document.getElementById('paymentReferenceContainer').style.display = "none";

            new bootstrap.Modal(document.getElementById('rentModal')).show();
        }

        document.getElementById('rentStartDate').addEventListener('change', calculateDays);
        document.getElementById('rentEndDate').addEventListener('change', calculateDays);

        function calculateDays() {
            const start = new Date(document.getElementById('rentStartDate').value);
            const end = new Date(document.getElementById('rentEndDate').value);
            const price = parseFloat(document.getElementById('carPrice').value);

            if (!isNaN(start) && !isNaN(end) && end > start) {
                const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
                document.getElementById('totalDays').value = days;
                document.getElementById('totalCost').value = `$${days * price}`;
            } else {
                document.getElementById('totalDays').value = '';
                document.getElementById('totalCost').value = '';
            }
        }

        document.getElementById('paymentMethod').addEventListener('change', function() {
            const refField = document.getElementById('paymentReferenceContainer');
            if (this.value === 'gcash' || this.value === 'card') {
                refField.style.display = 'block';
            } else {
                refField.style.display = 'none';
            }
        });


        document.getElementById('rentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const car_id = document.getElementById('car_id').value;
            const carPrice = document.getElementById('carPrice').value;
            const rentStartDate = document.getElementById('rentStartDate').value;
            const rentEndDate = document.getElementById('rentEndDate').value;

            /* const pickupLocation = document.getElementById('pickupLocation').value;
            const dropoffLocation = document.getElementById('dropoffLocation').value; */

            const totalCost = document.getElementById('totalCost').value.replace("₱", "").replace("$", "");

            const formData = new FormData();
            formData.append('car_id', car_id);
            formData.append('carPrice', carPrice);
            formData.append('rentStartDate', rentStartDate);
            formData.append('rentEndDate', rentEndDate);
            /* formData.append('pickupLocation', pickupLocation);
            formData.append('dropoffLocation', dropoffLocation); */
            formData.append('totalCost', totalCost);

            console.log([...formData.entries()]); // Debugging

            fetch('<?= base_url("/Renter/companycars") ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response Data:', data); // Debugging
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Your rental has been successfully submitted.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });

                        toastr.success('Rental submitted successfully!');

                        setTimeout(() => {
                            const rentModal = bootstrap.Modal.getInstance(document.getElementById('rentModal'));
                            rentModal.hide();
                            document.getElementById('rentForm').reset();
                            document.getElementById('carImage').src = '';
                            document.getElementById('totalDays').value = '';
                            document.getElementById('totalCost').value = '';
                            document.getElementById('paymentReferenceContainer').style.display = 'none';
                            hideSuccessAlert();
                        }, 1500);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Something went wrong.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
            /* .catch(error => {
                console.error('Fetch Error:', error); // Debugging
                Swal.fire({
                    title: 'Error!',
                    text: 'Error submitting rent: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }); */
        });

        function hideSuccessAlert() {
            document.getElementById('rentSuccessAlert').style.display = 'none';
        }

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