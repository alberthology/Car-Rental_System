<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: url('car1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.8);
            padding: 20px 0;
        }
        .navbar ul {
            list-style: none;
            display: flex;
            padding: 0;
        }
        .navbar ul li {
            margin: 0 20px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: bold;
            transition: 0.3s;
        }
        .navbar ul li a:hover {
            color: orange;
        }
        .hero {
            text-align: center;
            color: white;
            margin-top: 100px;
        }
        .hero h1 {
            font-size: 60px;
            margin-bottom: 10px;
        }
        .hero p {
            font-size: 24px;
        }
        .btn {
            display: inline-block;
            background: orange;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            font-size: 22px;
            margin-top: 20px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn:hover {
            background: yellow;
            color: black;
        }
        .form-container {
            width: 350px;
            margin: 80px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background: orange;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            color: white;
            cursor: pointer;
        }
        .form-container button:hover {
            background: yellow;
            color: black;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="#">Homepage</a></li>
            <li><a href="#">Cars</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">Sign Up</a></li>
        </ul>
    </div>
    <div class="hero">
        <h1>Explore the Best Cars</h1>
        <p>Drive your dreams with our premium rental services</p>
        <a href="#" class="btn">Get Started</a>
    </div>
    <div class="form-container">
        <h2>Login</h2>
        <form>
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
             <a href="index.html" class="btn">Log in</a>
        </form>
    </div>
</body>
</html>
