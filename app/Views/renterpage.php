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
        .sidebar ul li.active {
            background:rgb(36, 105, 174); /* Full background color */
            color: white;
            font-weight: bold;
            border-left: none; /* Remove left border */
            border-radius: 5px; /* Optional: Round the edges */


        }
        .sidebar ul li:hover {
            background: #34495e;
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
        .system-info {
            margin-top: 20px;
        }
        .company-cars h2 {
            color: rgb(0, 1, 1);
        }
        .rental-list {
            display: flex;
            gap: 150px;
            flex-wrap: wrap;
        }
        .h2 {
            color: rgb(1, 11, 17);
        }
        .rental-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            width: 250px;
            text-align: center;
        }
        .rental-card h3 {
            color: #2c3e50;
        }
        .rental-card p {
            font-size: 14px;
            color: #555;
        }
        .system-info {
            text-align: center;
            background: rgba(44, 62, 80, 0.9);
            color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
            width: 70%;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .tagline {
            font-size: 18px;
            font-style: italic;
            color: #f1c40f;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Renter Dashboard</h2>
        <ul>
            <li class="active"><a href="<?= base_url('renterpage') ?>">Homepage</a></li>
            <li><a href="<?= base_url('Renter/companycars') ?>">Company Cars</a></li>
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

        <div class="content-section system-info">
            <h2 class="title">Your Journey Starts Here</h2>
            <p class="tagline"><b>Rent a smile and fuel your laughs on every mile</b></p>
        </div>

        <div class="content-section company-cars">
            <h2>Company Car Rentals Overview</h2>
            <div class="rental-list">
                <div class="rental-card">
                    <img src="<?= base_url('public/assets/images/1.png') ?>" alt="Toyota Corolla">
                    <h3>EuropCar</h3>
                </div>
                <div class="rental-card">
                    <img src="<?= base_url('public/assets/images/3.jpg') ?>" alt="Honda Civic">
                    <h3>Avis</h3>
                </div>
                <div class="rental-card">
                    <img src="<?= base_url('public/assets/images/9.jpg') ?>" alt="BMW X5">
                    <h3>GOLDCAR</h3>
                </div>
            </div>
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