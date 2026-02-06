<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Favorites | Beauty Pharma</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css"/>


</head>
<body>

<!-- Hero -->
<section class="shop-hero text-center">
  <div class="container">
    <h1>My Favorites</h1>
    <p>Items you loved and saved for later</p>
  </div>
</section>

<!-- Favorites Grid -->
<section class="py-4">
  <div class="container">
       <div id="wishlist-container" class="row g-4"></div>
    <div class="row g-4">
      <?php for ($i = 1; $i <= 0; $i++): ?>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card position-relative text-center h-100">
            <img src="assets/images/product_cream.png" alt="Favorite <?= $i ?>">
            <div class="product-info">
              <h6>Favorite Product <?= $i ?></h6>
              <p class="mb-1">$<?= 12.50 + $i ?></p>
              <button class="btn btn-outline-dark btn-sm mb-2">Add to Cart</button>
            </div>
            <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" title="Remove from Favorites">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/wishlist.js"></script>
</body>
</html>
