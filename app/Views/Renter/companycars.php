<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renter Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
    border-left: none; /* Remove left border */
    font-weight: bold;
    border-radius: 5px;
}

.main-content {
    flex: 1;
    padding: 20px;
    margin-left: 250px; /* Match sidebar width */
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
            background: #34495e; /* Default tab background */
            color: white ; /* Default text color */
            border-radius: 5px;
        }

        .nav-tabs .nav-link.active {
            background: rgb(36, 105, 174) !important; /* Active tab background */
            font-weight: bold;
            color: white !important;
        }

        /* Tab content styling */
        .tab-content {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            margin-top: 10px;
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
            gap: 20px;
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
        <li><a href="<?= base_url('/logout') ?>">Logout</a></li>
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
                <button class="nav-link active" id="nav-europcar-tab" data-bs-toggle="tab" data-bs-target="#nav-europcar" type="button" role="tab">Europcar</button>
                <button class="nav-link" id="nav-hertz-tab" data-bs-toggle="tab" data-bs-target="#nav-hertz" type="button" role="tab">Hertz</button>
                <button class="nav-link" id="nav-avis-tab" data-bs-toggle="tab" data-bs-target="#nav-avis" type="button" role="tab">Avis</button>
                <button class="nav-link" id="nav-alamo-tab" data-bs-toggle="tab" data-bs-target="#nav-alamo" type="button" role="tab">Alamo</button>
                <button class="nav-link" id="nav-budget-tab" data-bs-toggle="tab" data-bs-target="#nav-budget" type="button" role="tab">Budget</button>
                <button class="nav-link" id="nav-national-tab" data-bs-toggle="tab" data-bs-target="#nav-national" type="button" role="tab">National</button>
                <button class="nav-link" id="nav-dollar-tab" data-bs-toggle="tab" data-bs-target="#nav-dollar" type="button" role="tab">Dollar</button>
            </div>
        </nav>

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
          <input type="hidden" id="carPrice">

          <!-- Car preview -->
          <div class="d-flex gap-4 align-items-center mb-3">
            <img id="carImage" src="" alt="Car Image" style="width: 150px; border-radius: 10px;">
            <div>
              <h5 id="modalCarName" class="mb-1"></h5>
              <p class="mb-0">Rate: $<span id="modalCarPrice"></span>/day</p>
            </div>
          </div>

          <!-- Rental Dates -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Rent Start Date</label>
              <input type="date" id="rentStartDate" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Return Date</label>
              <input type="date" id="rentEndDate" class="form-control" required>
            </div>
          </div>

          <!-- Summary -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Total Days</label>
              <input type="number" id="totalDays" class="form-control" disabled>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Total Cost ($)</label>
              <input type="text" id="totalCost" class="form-control" disabled>
            </div>
          </div>

          <!-- Payment Method -->
          <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select id="paymentMethod" class="form-select" required>
              <option value="">Choose...</option>
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

          <button type="submit" class="btn btn-success w-100">Confirm Rental</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="rentSuccessAlert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
  <strong>Successfully Rented!</strong> Your rental and payment info was submitted.
  <button type="button" class="btn-close" onclick="hideSuccessAlert()" aria-label="Close"></button>
</div>



        <!-- Tab Content -->
        <div class="tab-content" id="nav-tabContent">
            <!-- Europcar -->
            <div class="tab-pane fade show active" id="nav-europcar" role="tabpanel">
                <h2>Available Cars for Europcar</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/w.png') ?>" alt="Honda Civic">
                        <p>Honda Civic</p>
                        <p>2500/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda Civic', 45)">Rent Now</button>
                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/r.jpg') ?>" alt="Chevrolet Malibu">
                        <p>Chevrolet Malibu</p>
                        <p>2600/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Chevrolet Malibu', 55)">Rent Now</button>
                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/q.jpg') ?>" alt="Chevrolet Malibu">
                        <p>Toyota Camry</p>
                        <p>2000/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Camry', 55)">Rent Now</button>
                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/e.jpg') ?>" alt="Chevrolet Malibu">
                        <p>Ford Mustang</p>
                        <p>2700/day</p>
                        <p class="text-danger">Not Available</p>
                        <button class="btn btn-secondary" disabled>Rent Now</button>
                    </div>
                </div>
            </div>

            <!-- Hertz -->
            <div class="tab-pane fade" id="nav-hertz" role="tabpanel">
                <h2>Available Cars for Hertz</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/t1.jpg') ?>" alt="Toyota Hilux">
                        <p>Toyota Hilux</p>
                        <p>$45/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Hilux', 55)">Rent Now</button>
                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/t2.jpg') ?>" alt="Toyota Fortuner">
                        <p>Toyota Fortuner</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Fortuner', 55)">Rent Now</button>
                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/t3.jpg') ?>" alt="Honda Civic">
                        <p>Toyota Glanza</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Glanza', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h1.jpg') ?>" alt="Honda Civic">
                        <p>Honda Civic</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda Civic', 55)">Rent Now</button>                    </div>
                </div>
            </div>
                

            <!-- Avis -->
            <div class="tab-pane fade" id="nav-avis" role="tabpanel">
                <h2>Available Cars for Avis</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h2.jpg') ?>" alt="Honda CR-V">
                        <p>Honda CR-V</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda CR-V', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h3.png') ?>" alt="Honda Accord">
                        <p>Honda Accord</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda Accord', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/m1.png') ?>" alt="Mitsubishi Xpander">
                        <p>Mitsubishi Xpander</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Mitsubishi Xpander', 55)">Rent Now</button>                    </div>
                </div>
            </div>

            <!-- Alamo -->
            <div class="tab-pane fade" id="nav-alamo" role="tabpanel">
                <h2>Available Cars for Alamo</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h2.jpg') ?>" alt="Honda CR-V">
                        <p>Honda CR-V</p>
                        <p>50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda CR-V', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h3.png') ?>" alt="Honda Accord">
                        <p>Honda Accord</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda Accord', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/m1.png') ?>" alt="Mitsubishi Xpander">
                        <p>Mitsubishi Xpander</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Mitsubishi Xpander', 55)">Rent Now</button>                    </div>
                </div>
            </div>

            <!-- Budget -->
             <div class="tab-pane fade" id="nav-budget" role="tabpanel">
                <h2>Available Cars for Budget</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/t1.jpg') ?>" alt="Toyota Hilux">
                        <p>Toyota Hilux</p>
                        <p>$45/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Hilux', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/t2.jpg') ?>" alt="Toyota Fortuner">
                        <p>Toyota Fortuner</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Fortuner', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/t3.jpg') ?>" alt="Honda Civic">
                        <p>Toyota Glanza</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Glanza', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h1.jpg') ?>" alt="Honda Civic">
                        <p>Honda Civic</p>
                        <p>$50/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda Civic', 55)">Rent Now</button>                    </div>
                </div>
            </div>

             <!-- National -->
             <div class="tab-pane fade" id="nav-national" role="tabpanel">
                <h2>Available Cars for National</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/w.png') ?>" alt="Honda Civic">
                        <p>Honda Civic</p>
                        <p>$45/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda Civic', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/r.jpg') ?>" alt="Chevrolet Malibu">
                        <p>Chevrolet Malibu</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Chevrolet Malibu', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/q.jpg') ?>" alt="Chevrolet Malibu">
                        <p>Toyota Camry</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Toyota Camry', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/e.jpg') ?>" alt="Chevrolet Malibu">
                        <p>Ford Mustang</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Ford Mustang', 55)">Rent Now</button>                    </div>
                </div>
            </div>
            <!--Dollar-->
            <div class="tab-pane fade" id="nav-dollar" role="tabpanel">
                <h2>Available Cars for Dollar</h2>
                <div class="car-list">
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/n1.jpg') ?>" alt="Nissan Terra">
                        <p>Nissan Terra</p>
                        <p>$45/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Nissan Terra', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/m1.png') ?>" alt="Mitsubishi Xpander">
                        <p>Mitsubishi Xpander</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Mitsubishi Xpander', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/m2.jpg') ?>" alt="Mitsubishi Pajero">
                        <p>Mitsubishi Pajero</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Mitsubishi Pajero', 55)">Rent Now</button>                    </div>
                    <div class="car">
                        <img src="<?= base_url('public/assets/images/h2.jpg') ?>" alt="Honda CR-V">
                        <p>Honda CR-V</p>
                        <p>$55/day</p>
                        <button class="btn btn-primary" onclick="openRentModal('Honda CR-V', 55)">Rent Now</button>                    </div>
                </div>
            </div>


            <script>
function openRentModal(carName, pricePerDay) {
    document.getElementById('carName').value = carName;
    document.getElementById('carPrice').value = pricePerDay;
    document.getElementById('modalCarName').innerText = carName;
    document.getElementById('modalCarPrice').innerText = pricePerDay;

    // Optionally update the image
    let imageMap = {
        "Honda Civic": "w.png",
        "Chevrolet Malibu": "r.jpg",
        "Toyota Camry": "q.jpg",
        "Ford Mustang": "e.jpg",
        "Toyota Hilux": "t1.jpg",
        "Toyota Fortuner": "t2.jpg",
        "Toyota Glanza": "t3.jpg",
        "Honda CR-V": "h2.jpg",
        "Honda Accord": "h3.png",
        "Mitsubishi Xpander": "m1.png",
        "Mitsubishi Pajero": "m2.jpg",
        "Nissan Terra": "n1.jpg"
    };
    const imgFile = imageMap[carName] ? imageMap[carName] : 'default.jpg';
    document.getElementById('carImage').src = "<?= base_url('public/assets/images/') ?>" + imgFile;

    // Reset fields
    document.getElementById('rentStartDate').value = "";
    document.getElementById('rentEndDate').value = "";
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

document.getElementById('paymentMethod').addEventListener('change', function () {
    const refField = document.getElementById('paymentReferenceContainer');
    if (this.value === 'gcash' || this.value === 'card') {
        refField.style.display = 'block';
    } else {
        refField.style.display = 'none';
    }
});


document.getElementById('rentForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Optional: Validate inputs if needed

    // Show success alert
    document.getElementById('rentSuccessAlert').style.display = 'block';

    // Optionally close modal after short delay
    setTimeout(() => {
        const rentModal = bootstrap.Modal.getInstance(document.getElementById('rentModal'));
        rentModal.hide();

        // Reset form
        this.reset();
        document.getElementById('paymentReferenceContainer').style.display = "none";
        document.getElementById('carImage').src = '';
        document.getElementById('totalDays').value = '';
        document.getElementById('totalCost').value = '';
    }, 1000);
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
