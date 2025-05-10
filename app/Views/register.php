<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('<?= base_url("public/assets/images/car1.png") ?>');
        }

        .container {
            max-width: 500px;
            margin-top: 2rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs {
            border-bottom: 2px solid #dee2e6;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 1rem 1.5rem;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 2px solid #0d6efd;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.75rem;
        }

        .btn-primary {
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .password-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>
                <a href="<?= base_url('/loginpage') ?>" class="btn-black"> <i class="fas fa-arrow-left"></i></a>
                <h3 class="text-center mb-4">Create Account</h3>
                <ul class="nav nav-tabs mb-4" role="tablist" aria-label="Registration tabs">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#renter" type="button" role="tab" aria-selected="true" aria-controls="renter" id="renter-tab">
                            <i class="fas fa-user me-2"></i>Renter
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-selected="false" aria-controls="company" id="company-tab">
                            <i class="fas fa-building me-2"></i>Company
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Renter Form -->
                    <div class="tab-pane fade show active" id="renter" role="tabpanel">
                        <form action="<?= base_url('/register/registerRenter') ?>" method="post">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="dob" class="form-control" placeholder="Date of Birth" required>
                                </div>
                                <div class="col-md-6">
                                    <select name="gender" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="license" class="form-control" placeholder="Driver's License Number" required>
                                </div>
                                <div class="col-12 password-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <i class="fas fa-eye password-toggle"></i>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="role" value="renter"> <!-- important ni -->
                                    <button type="submit" class="btn btn-primary w-100">Create Account</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- Company Form -->
                    <div class="tab-pane fade" id="company" role="tabpanel">
                        <form action="<?= base_url('register/registerCompany') ?>" method="post">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="address" class="form-control" placeholder="Address" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="year_established" class="form-control" placeholder="Year Established" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="col-12 password-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <i class="fas fa-eye password-toggle"></i>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="role" value="company">
                                    <button type="submit" class="btn btn-primary w-100">Create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>

</html>