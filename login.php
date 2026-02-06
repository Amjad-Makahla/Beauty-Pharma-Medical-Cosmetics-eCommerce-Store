<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Beauty Pharma</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/styles.css"/>
</head>
<body>

<section class="d-flex align-items-center justify-content-center login-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="row login-card bg-white">
          
          <!-- Left: Form -->
          <div class="col-md-6 login-form-container">
            <h3 class="auth-title text-center">Welcome Back</h3>
           <form id="loginForm">
  <div class="mb-3">
    <label class="form-label">Email Address</label>
    <input type="email" id="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary-custom w-100 mt-2">Login</button>
</form>

            <p class="text-center mt-3">Don't have an account? 
              <a href="signup.php" class="text-decoration-none" style="color: var(--color-primary);">Sign up</a>
            </p>
          </div>

          <!-- Right: Image -->
          <div class="col-md-6 d-none d-md-block login-image"></div>

        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/login.js"></script>

</body>
</html>
