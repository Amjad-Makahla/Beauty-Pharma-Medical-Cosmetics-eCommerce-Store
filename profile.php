<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile | Beauty Pharma</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <link rel="stylesheet" href="assets/css/styles.css"/>
</head>
<body>

<section class="profile-section">
  <div class="container">
    
    <!-- Profile Info -->
    <div class="row justify-content-center mb-5">
      <div class="col-lg-10">
        <div class="profile-card">
          <img src="assets/images/profile_avatar.png" alt="User" class="profile-img">
          <h4 class="profile-title">Yousef Abushaar</h4>
          <button id="logoutBtn" class="btn btn-outline-danger btn-sm">Logout</button>
          <p class="text-muted mb-4">yousef@example.com</p>

          <div class="row text-start justify-content-center">
            <div class="col-md-5 mb-3">
              <p><span class="info-label">Phone:</span> +962-7XXXXXXX</p>
              <p><span class="info-label">Address:</span> Amman, Jordan</p>
            </div>
            <div class="col-md-5 mb-3">
              <p><span class="info-label">Joined:</span> Jan 5, 2024</p>
              <p><span class="info-label">Last Login:</span> July 20, 2025</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Orders -->
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="order-card">
          <h5 class="text-center mb-4" style="color: var(--color-primary); font-weight: 600;">Past Orders</h5>

          <div class="table-responsive">
            <table class="table order-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Items</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/profile.js"></script>
</body>
</html>
