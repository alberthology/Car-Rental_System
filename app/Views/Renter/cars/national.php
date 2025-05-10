<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('<?= base_url("public/assets/images/6.jpg") ?>');
            background-size: 1600px 1000px;
            background-repeat: no-repeat;
        }


        .not-available {
            filter: grayscale(100%) brightness(50%);
            pointer-events: none;
        }
    </style>
</head>
<body>
      
        <!-- Car Item 1 -->
    <div class="container mt-5">
    <a href="<?= base_url('Renter/companycars') ?>" class="btn btn-secondary mb-3">Back to Company Cars</a>
    <h2 class="text-center">Available Cars for National</h2>
    <div class="row mt-4">
        
        <!-- Car Item 1 -->
        <div class="col-md-3">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/t1.jpg') ?>" class="card-img-top" alt="Toyota Hilux">
                <div class="card-body">
                    <h5 class="card-title">Toyota Hilux</h5>
                    <p class="text-success">$45/day</p>
                    <button class="btn btn-primary rent-now" data-name="Toyota Hilux" data-price="45">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 2 -->
        <div class="col-md-3">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/t2.jpg') ?>" class="card-img-top" alt="Toyota Fortuner">
                <div class="card-body">
                    <h5 class="card-title">Toyota Fortuner</h5>
                    <p class="text-success">$55/day</p>
                    <button class="btn btn-primary rent-now" data-name="Toyota Fortuner" data-price="55">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 3 -->
        <div class="col-md-3">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/t3.jpg') ?>" class="card-img-top" alt="Toyota Glanza">
                <div class="card-body">
                    <h5 class="card-title">Toyota Glanza</h5>
                    <p class="text-success">$50/day</p>
                    <button class="btn btn-primary rent-now" data-name="Toyota Glanza" data-price="50">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 4 -->
        <div class="col-md-3">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/h1.jpg') ?>" class="card-img-top" alt="Honda Civic">
                <div class="card-body">
                    <h5 class="card-title">Honda Civic</h5>
                    <p class="text-success">$50/day</p>
                    <button class="btn btn-primary rent-now" data-name="Honda Civic" data-price="50">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 5 -->
        <div class="col-md-3 mt-4">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/h2.jpg') ?>" class="card-img-top" alt="Honda CR-V">
                <div class="card-body"><br>
                    <h5 class="card-title">Honda CR-V</h5>
                    <p class="text-success">$60/day</p>
                    <button class="btn btn-primary rent-now" data-name="Honda CR-V" data-price="60">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 6 -->
        <div class="col-md-3 mt-4">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/h3.png') ?>" class="card-img-top" alt="Honda Accord">
                <div class="card-body">
                    <h5 class="card-title">Honda Accord</h5>
                    <p class="text-success">$65/day</p>
                    <button class="btn btn-primary rent-now" data-name="Honda Accord" data-price="65">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 7 -->
        <div class="col-md-3 mt-4">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/m1.png') ?>" class="card-img-top" alt="Mitsubishi Xpander">
                <div class="card-body"><br>
                    <h5 class="card-title">Mitsubishi Xpander</h5>
                    <p class="text-success">$55/day</p>
                    <button class="btn btn-primary rent-now" data-name="Mitsubishi Xpander" data-price="55">Rent Now</button>
                </div>
            </div>
        </div>

        <!-- Car Item 8 -->
        <div class="col-md-3 mt-4">
            <div class="card text-center">
                <img src="<?= base_url('public/assets/images/m2.jpg') ?>" class="card-img-top" alt="Mitsubishi Pajero">
                <div class="card-body"><br>
                    <h5 class="card-title">Mitsubishi Pajero</h5>
                    <p class="text-success">$75/day</p>
                    <button class="btn btn-primary rent-now" data-name="Mitsubishi Pajero" data-price="75">Rent Now</button>
                </div>
            </div>
        </div>




<!-- Modal -->
<div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="rentModalLabel">Rent a Car</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Car:</strong> <span id="carName"></span></p>
        <p><strong>Price per day:</strong> $<span id="carPrice"></span></p>
        
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" class="form-control" onchange="calculateTotal()">
        
        <label for="endDate" class="mt-2">End Date:</label>
        <input type="date" id="endDate" class="form-control" onchange="calculateTotal()">
        
        <p class="mt-2"><strong>Total Price:</strong> $<span id="totalPrice">0</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="confirmRental()">Confirm Rental</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let rentButtons = document.querySelectorAll(".rent-now");

    rentButtons.forEach(button => {
        button.addEventListener("click", function() {
            let carName = this.getAttribute("data-name");
            let carPrice = this.getAttribute("data-price");

            document.getElementById("carName").innerText = carName;
            document.getElementById("carPrice").innerText = carPrice;
            document.getElementById("totalPrice").innerText = "0"; // Reset total price

            document.getElementById("startDate").value = "";
            document.getElementById("endDate").value = "";

            let rentModal = new bootstrap.Modal(document.getElementById('rentModal'));
            rentModal.show();
        });
    });
});

function calculateTotal() {
    let startDate = new Date(document.getElementById("startDate").value);
    let endDate = new Date(document.getElementById("endDate").value);
    let pricePerDay = parseInt(document.getElementById("carPrice").innerText);

    if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && endDate >= startDate) {
        let timeDifference = endDate - startDate;
        let days = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)) + 1; // Include the last day
        let totalPrice = days * pricePerDay;
        document.getElementById("totalPrice").innerText = totalPrice;
    } else {
        document.getElementById("totalPrice").innerText = "0";
    }
}


function confirmRental() {
    let carName = document.getElementById("carName").innerText;
    let carPrice = document.getElementById("carPrice").innerText;
    let startDate = document.getElementById("startDate").value;
    let endDate = document.getElementById("endDate").value;
    let totalPrice = document.getElementById("totalPrice").innerText;

    if (startDate === "" || endDate === "") {
        alert("Please select a start and end date.");
        return;
    }

    let url = `<?= base_url('Renter/confirmBooking') ?>?car=${encodeURIComponent(carName)}&price=${encodeURIComponent(carPrice)}&start=${encodeURIComponent(startDate)}&end=${encodeURIComponent(endDate)}&total=${encodeURIComponent(totalPrice)}`;
    
    window.location.href = url;
}



</script>

</body>
</html>