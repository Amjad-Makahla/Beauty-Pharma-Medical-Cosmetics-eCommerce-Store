<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop | Beauty Pharma</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css" />

</head>
<body>

<!-- Hero Section -->
<section class="shop-hero">
  <div class="container">
    <h1>Discover Our Collection</h1>
    <p>Your skincare favorites, all in one place.</p>
  </div>
</section>

<!-- Product + Filter Section -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      
      <!-- Filters -->
<!-- Filters -->
<div class="col-md-3">
  <div class="filter-sidebar shadow-sm">
    <h5>Filter</h5>

    <select class="form-select mb-2" id="brandFilter" data-filter="brand">
      <option value="">Brand</option>
    </select>

    <select class="form-select mb-2" id="categoryFilter" data-filter="category">
      <option value="">Category</option>
    </select>

    <select class="form-select mb-2" id="priceFilter" data-filter="price">
      <option value="">Price Range</option>
    </select>

    <button id="applyFiltersBtn" class="btn btn-dark w-100 mt-2">Apply Filters</button>
  </div>
</div>



      <!-- Products -->
      <div class="col-md-9">
        <div class="row g-4">
          <?php for ($i = 1; $i <= 12; $i++): ?>
            <div class="col-6 col-md-4">
              <div class="product-card text-center h-100 position-relative">
  <!-- Favorite Icon -->
 <!-- Favorite Icon -->
<button class="btn p-0 border-0 position-absolute top-0 end-0 m-2 favorite-btn" data-product-id="<?= $i ?>">
  <i class="bi bi-heart fs-5 text-danger"></i> <!-- Will be toggled to bi-heart-fill via JS -->
</button>

  <a href="single_product.php?product_id=1">

  <!-- Product Image -->
  <img src="assets/images/product_cream.png" alt="Product <?= $i ?>">

  <!-- Product Info -->
  <div class="product-info">
    <h5>Product Name <?= $i ?></h5>
    <p>$<?= 9.99 + $i ?>.00</p>
    <button class="btn btn-outline-dark btn-sm">Add to Cart</button>
  </div>
</div>
          </a>

            </div>
          <?php endfor; ?>
        </div>

        <!-- Pagination -->
        <nav class="modern-pagination d-flex justify-content-center pt-4">
          <ul class="pagination gap-2">
            <li class="page-item disabled"><a class="page-link">Previous</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/shop.js"></script>

</body>
</html>
