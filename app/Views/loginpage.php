<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">
  <title>Log In</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Font Awesome Icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- jQuery (required for Toastr) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <style>
    body#LoginForm {
      background: url('<?= base_url("public/assets/images/car1.png") ?>');
      background-size: 2000px 1500px;
      background-repeat: no-repeat;
      background-position: center;
      padding: 10px;
    }

    .main-div {
      background: #ffffff;
      border-radius: 8px;
      margin: 10px auto 30px;
      max-width: 38%;
      padding: 50px 70px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .btn-black {
      background-color: rgb(84, 169, 255);
      color: #fff;
      margin-top: 10px;
      width: 100%;
      padding: 10px;
      font-size: 17px;
      font-weight: bolder;
      border-radius: 5px;
      border: none;
      cursor: pointer;
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

    .password-group {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6c757d;
    }
  </style>
</head>

<body id="LoginForm">
  <div class="container">
    <h1 class="text-center text-black"><b>Car Rental Management System</b></h1><br><br>
    <div class="main-div">
      <h2><b>Sign In</b></h2>
      <p>Enter your email and password</p>

      <!-- Display error message -->
      <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <form id="Login" action="<?= base_url('auth/loginProcess') ?>" method="POST">
        <div class="form-group">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" required><br>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required><br>
        </div>
        <button type="submit" class="btn-black">Log In</button>
      </form>

      <br>
      <!-- <a href="<?= base_url('/register') ?>" class="btn-black">Register</a> -->
      <button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#registerModal">
        Register
      </button>


      <div class="forgot mt-3">
        <!-- <a href="<?= base_url('forgot') ?>">Forgot Password?</a> -->
        <p class="text-muted">Forgot Password? <a href="#"> Contact Us</a></p>
      </div>
    </div>
  </div>


  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="registerModalLabel">Register</h5> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!--  registration form -->

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
                <!-- <a href="<?= base_url('/loginpage') ?>" class="btn-black"> <i class="fas fa-arrow-left"></i></a> -->
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
                            <!-- <option value="other">Other</option> -->
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


        </div>
      </div>
    </div>
  </div>




  <script>
    <?php if (session()->getFlashdata('success')) : ?>
      toastr.success("<?= session()->getFlashdata('success') ?>");
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
      toastr.error("<?= session()->getFlashdata('error') ?>");
    <?php endif; ?>
  </script>

</body>

</html>


<!-- <body id="LoginForm">
  <div class="container">
    <h1 class="text-center text-black"><b>Car Rental Management System</b></h1><br><br>
    <div class="main-div">
      <h2><b>Sign In</b></h2>
      <p>Enter your email and password</p>
      
      <form id="Login" action="<?= base_url('auth/loginProcess') ?>" method="POST">


        <div class="form-group">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" required><br>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required><br>
        </div>
        <button type="submit" class="btn-black">Log In</button>
      </form>

      <br>
      <a href="<?= base_url('Renter/register') ?>" class="btn-black">Register</a>

      <div class="forgot mt-3">
        <a href="<?= base_url('forgot') ?>">Forgot Password?</a>
      </div>
    </div>
  </div>
</body> -->