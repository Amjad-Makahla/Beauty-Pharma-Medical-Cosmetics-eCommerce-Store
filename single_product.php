<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Product Details | Beauty Pharma</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>

<!-- Product Detail Section -->
<section class="product-detail-section">
  <div class="container">
    <div class="row g-5 align-items-start">
      
      <!-- Image -->
      <div class="col-md-6">
        <img src="assets/images/product_cream.png" alt="Product Image" class="product-image img-fluid">
      </div>

      <!-- Details -->
      <div class="col-md-6">
        <div class="d-flex align-items-start justify-content-between">
          <h1 class="product-title mb-0">Hydrating Night Cream</h1>
         <button class="btn p-0 border-0 ms-3 favorite-btn" data-product-id="<?= $product_id ?>"> 
  <i class="bi bi-heart fs-4 text-danger"></i>
</button>

        </div>

        <div class="product-meta mb-3">
          <small><strong>Brand:</strong> GlowCare</small><br>
          <small><strong>Category:</strong> Skin</small><br>
        </div>

        <p class="product-price">$24.99</p>

        <table class="table table-borderless product-info-table w-75">
          <tbody>
            <tr><td><strong>Size:</strong></td><td>50ml</td></tr>
            <tr><td><strong>Weight:</strong></td><td>120g</td></tr>
          </tbody>
        </table>

        <p class="product-description">
          A deeply moisturizing night cream with hyaluronic acid and vitamin E to nourish your skin while you sleep. Ideal for dry and sensitive skin.
        </p>

      <button class="btn btn-dark px-4 cart-btn" data-product-id="123">
  <i class="bi bi-bag me-2"></i> <span class="cart-text">Add to Cart</span>
</button>

      </div>
    </div>
  </div>
</section>

<!-- Related Products -->
<section class="related-products">
  <div class="container">
    <h4 class="mb-4 fw-semibold">You may also like</h4>
    <div class="row g-3">
      <?php for ($i = 1; $i <= 4; $i++): ?>
        <div class="col-6 col-md-3">
  <div class="product-card text-center p-2 position-relative border rounded bg-white shadow-sm">
    <button class="btn p-0 border-0 position-absolute top-0 end-0 m-2 favorite-btn" data-product-id="<?= $i ?>">
      <i class="bi bi-heart fs-5 text-danger"></i>
    </button>
      <a href="single_product.php?product_id=1">

    <img src="assets/images/product_cream.png" alt="Related Product" class="w-100">
    <h5 class="mt-2 mb-1">Face Cream <?= $i ?></h5>
    <p>$<?= 19 + $i ?>.00</p>
      </a>

  </div>
</div>

      <?php endfor; ?>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/single_product.js"></script>
</body>
</html>
