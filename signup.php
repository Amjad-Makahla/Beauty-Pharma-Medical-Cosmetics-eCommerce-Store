<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up | Beauty Pharma</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/styles.css"/>
</head>
<body>

<section class="d-flex align-items-center justify-content-center signup-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="row signup-card bg-white">
          
          <!-- Left: Image -->
          <div class="col-md-6 d-none d-md-block signup-image"></div>

          <!-- Right: Form -->
          <div class="col-md-6 signup-form-container">
            <h3 class="auth-title text-center">Create an Account</h3>
          <form id="signupForm">
  <div class="mb-3">
    <label class="form-label">Full Name</label>
    <input type="text" id="name" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Email Address</label>
    <input type="email" id="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Phone Number</label>
    <input type="text" id="phone" name="phone" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" id="cpassword" name="cpassword" class="form-control" required>
  </div>

  <button type="submit" class="btn btn-primary-custom w-100 mt-2">Sign Up</button>
</form>

            <p class="text-center mt-3">Already have an account? 
              <a href="login.php" class="text-decoration-none" style="color: var(--color-primary);">Log in</a>
            </p>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/signup.js"></script>
</body>
</html>
