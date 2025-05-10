<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: white;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .car-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .back-button {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('Renter/companycars') ?>" class="back-button">&larr; Back to Cars</a>
        <h2>Car Details hello</h2>
        <?php 
        $car_name = isset($_GET['car']) ? $_GET['car'] : 'Unknown Car';
        $car_details = [
            'Europcar' => ['image' => '1.png', 'desc' => 'Premium comfort and fuel-efficient.'],
            'Hertz' => ['image' => '2.png', 'desc' => 'Luxury rides with modern technology.'],
            'Avis' => ['image' => '3.jpg', 'desc' => 'Spacious and stylish for long trips.'],
        ];
        if (array_key_exists($car_name, $car_details)): ?>
            <h3><?= htmlspecialchars($car_name) ?></h3>
            <img src="<?= base_url('public/assets/images/' . $car_details[$car_name]['image']) ?>" class="car-image" alt="Car Image">
            <p><?= $car_details[$car_name]['desc'] ?></p>
        <?php else: ?>
            <p>Car details not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
