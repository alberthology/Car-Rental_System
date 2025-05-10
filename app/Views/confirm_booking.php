<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
    font-family: 'Poppins', sans-serif;
    background-color:rgb(44, 45, 44);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

h2 {
    font-size: 22px;
    color: #333;
    margin-bottom: 20px;
}

.info {
    text-align: left;
    margin-bottom: 20px;
}

.info p {
    font-size: 16px;
    margin: 8px 0;
}

button {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}

.book-btn {
    background: #2D8C50;
    color: white;
}

.book-btn:hover {
    background: #23703D;
}

.cancel-btn {
    background: #6c757d;
    color: white;
    margin-top: 10px;
}

.cancel-btn:hover {
    background: #5a6268;
}


</style>
<body>
<div class="container mt-5">
    <h2 class="text-center">Confirm Your Booking</h2>
    <div class="card p-4">
        <p><strong>Car:</strong> <?= $car ?></p>
        <p><strong>Price per day:</strong> $<?= $price ?></p>
        <p><strong>Start Date:</strong> <?= $start ?></p>
        <p><strong>End Date:</strong> <?= $end ?></p>
        <p><strong>Total Price:</strong> $<?= $total ?></p>
        <a href="<?= base_url('Renter/bookNow') ?>" class="btn btn-success">Book Now</a>
        <a href="<?= base_url('Renter/companycars') ?>" class="btn btn-secondary">Cancel</a>
    </div>
</div>
</body>
</html>
