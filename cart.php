<?php include 'offer_nav.php'; ?>
<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cart | Beauty Pharma</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/styles.css"/>

</head>
<body>

<!-- Hero Section -->
<section class="cart-hero text-center">
  <div class="container">
    <h1>Your Shopping Cart</h1>
    <p class="text-light">Review your selected products before checkout</p>
  </div>
</section>

<!-- Cart Section -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Cart Items -->
      <div class="col-lg-8">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>Product</th>
                <th class="text-center">Price</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Total</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i = 1; $i <= 1; $i++): ?>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    
                    <div>
                      <strong></strong><br/>
                      <small class="text-muted"></small>
                    </div>
                  </div>
                </td>
                <td class="text-center"></td>
                <td class="text-center">
<input 
  type="number" 
  min="1" 
  value="" 
  class="form-control form-control-sm text-center qty-input" 
  data-product-id=""
  style="width: 60px; margin: auto;">
                </td>
                <td class="text-center"></td>
                <td class="text-center">
                  <button class="btn-remove"><i class="bi bi-trash-fill fs-5"></i></button>
                </td>
              </tr>
              <?php endfor; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Summary and Promo -->
      <div class="col-lg-4">
        <div class="border rounded p-4 summary-box">
          <h5 class="mb-3">Order Summary</h5>

          <!-- Promo Code -->
          <form class="mb-3 promo-section">
            <label for="promoCode" class="form-label fw-semibold">Promo Code</label>
            <div class="input-group">
              <input type="text" id="promoCode" class="form-control" placeholder="Enter code">
              <button type="submit" class="btn text-white">Apply</button>
            </div>
          </form>

                  <!-- Summary Details -->
<div class="summary-box">
  <div class="d-flex justify-content-between mb-2">
    <span>Subtotal</span>
    <span id="subtotal">$0.00</span> <!-- updated to have an id -->
  </div>
  <div class="d-flex justify-content-between mb-2">
    <span>Shipping</span>
    <span id="shipping">$0.00</span> <!-- updated to have an id -->
  </div>
  <hr/>
  <div class="d-flex justify-content-between fw-bold mb-4">
    <span>Total</span>
    <span id="total">$0.00</span> <!-- updated to have an id -->
  </div>
  <button class="btn btn-checkout w-100 text-white py-2">Proceed to Checkout</button>
</div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="module" src="assets/js/cart.js"></script>
</body>
</html>
