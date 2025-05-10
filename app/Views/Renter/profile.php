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
            background-size: cover;
            background-repeat: no-repeat;
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
            background:rgb(36, 105, 174);
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .dashboard {
            background: white;
            padding: 25px;
            border-radius: 10px;
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
        
        /* Profile Update Styles */
        .profile-section, .history-section {
            margin-top: 20px;
        }
        .profile-section h3, .history-section h3 {
            background: #333;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        
        .profile-details, .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .profile-details td, .history-table td, .history-table th {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .history-table th {
            background: #333;
            color: white;
        }
        
        /* Button Styles */
        .update-btn, .save-btn, .cancel-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            margin-top: 15px;
        }
        .update-btn {
            background: #27ae60;
            color: white;
        }
        .update-btn:hover {
            background: #219150;
        }
        .save-btn {
            background: #3498db;
            color: white;
        }
        .save-btn:hover {
            background: #2980b9;
        }
        .cancel-btn {
            background: #e74c3c;
            color: white;
        }
        .cancel-btn:hover {
            background: #c0392b;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
            margin-top: 120px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
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
            <li><a href="<?= base_url('Renter/rent') ?>">Renter</a></li>
            <li class="active"><a href="<?= base_url('Renter/profile') ?>">Profile</a></li>
            <li><a href="<?= base_url('/logout') ?>">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="nav-bar-card">
            <h1>Car Rental Management System</h1>
        </div>

        <div class="dashboard">
            <h2>Profile</h2>
            <div class="profile-section">
                <h3>Personal Information</h3>
                <table class="profile-details">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td id="name-view">John Amoguis</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td id="email-view">john@gmail.com</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td id="phone-view">+123 456 7890</td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td id="address-view">Cugman CDO</td>
                    </tr>
                    <tr>
                        <td><strong>Birthday:</strong></td>
                        <td id="birthdate-view">2000-01-01</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong></td>
                        <td id="gender-view">Male</td>
                    </tr>
                    <tr>
                        <td><strong>Driver's License No.:</strong></td>
                        <td id="license-view">ABCD1234567</td>
                    </tr>
                </table>
                
                <button class="update-btn" onclick="openModal()">Update Profile</button>
            </div>
            
            <div class="history-section">
                <h3>Rental History</h3>
                <table class="history-table">
                    <tr>
                        <th>Car</th>
                        <th>Rental Date</th>
                        <th>Return Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>Toyota Corolla</td>
                        <td>2024-03-01</td>
                        <td>2024-03-05</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>Honda Civic</td>
                        <td>2024-03-10</td>
                        <td>2024-03-15</td>
                        <td>Ongoing</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="profileModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Update Profile</h3>
            <form id="profileForm">
                <div class="form-group">
                    <label for="modal-name">Name:</label>
                    <input type="text" id="modal-name" value="John Amoguis">
                </div>
                <div class="form-group">
                    <label for="modal-email">Email:</label>
                    <input type="email" id="modal-email" value="john@gmail.com">
                </div>
                <div class="form-group">
                    <label for="modal-phone">Phone:</label>
                    <input type="tel" id="modal-phone" value="+123 456 7890">
                </div>
                <div class="form-group">
                    <label for="modal-address">Address:</label>
                    <input type="text" id="modal-address" value="Cugman CDO">
                </div>
                <div class="form-group">
                    <label for="modal-birthdate">Birthday:</label>
                    <input type="date" id="modal-birthdate" value="2000-01-01">
                </div>
                <div class="form-group">
                    <label for="modal-gender">Gender:</label>
                    <select id="modal-gender">
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="modal-license">Driver's License No.:</label>
                    <input type="text" id="modal-license" value="ABCD1234567">
                </div>
                <button type="button" class="save-btn" onclick="saveProfile()">Save Changes</button>
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        // Open modal and populate with current values
        function openModal() {
            // Get current values from the view
            document.getElementById('modal-name').value = document.getElementById('name-view').textContent;
            document.getElementById('modal-email').value = document.getElementById('email-view').textContent;
            document.getElementById('modal-phone').value = document.getElementById('phone-view').textContent;
            document.getElementById('modal-address').value = document.getElementById('address-view').textContent;
            document.getElementById('modal-birthdate').value = document.getElementById('birthdate-view').textContent;
            document.getElementById('modal-gender').value = document.getElementById('gender-view').textContent;
            document.getElementById('modal-license').value = document.getElementById('license-view').textContent;
            
            // Show the modal
            document.getElementById('profileModal').style.display = 'block';
        }

        // Close modal
        function closeModal() {
            document.getElementById('profileModal').style.display = 'none';
        }
        
        // Save profile data
        function saveProfile() {
            // Update the view with new values from the modal
            document.getElementById('name-view').textContent = document.getElementById('modal-name').value;
            document.getElementById('email-view').textContent = document.getElementById('modal-email').value;
            document.getElementById('phone-view').textContent = document.getElementById('modal-phone').value;
            document.getElementById('address-view').textContent = document.getElementById('modal-address').value;
            document.getElementById('birthdate-view').textContent = document.getElementById('modal-birthdate').value;
            document.getElementById('gender-view').textContent = document.getElementById('modal-gender').value;
            document.getElementById('license-view').textContent = document.getElementById('modal-license').value;

            // Here you would typically send data to server via AJAX
            // Example:
            /*
            fetch('<?= base_url('Renter/updateProfile') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: document.getElementById('modal-name').value,
                    email: document.getElementById('modal-email').value,
                    phone: document.getElementById('modal-phone').value,
                    address: document.getElementById('modal-address').value,
                    birthdate: document.getElementById('modal-birthdate').value,
                    gender: document.getElementById('modal-gender').value,
                    license: document.getElementById('modal-license').value
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    closeModal();
                }
            });
            */
            
            // For demo purposes, just close the modal
            closeModal();
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('profileModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>