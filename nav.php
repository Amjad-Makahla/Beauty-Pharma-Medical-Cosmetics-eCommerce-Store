<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Beauty Pharma</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css" />
</head>
<body class="bg-light">

<!-- ========== Navbar ========== -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="home.php">
      <img src="assets/images/logo.png" alt="logo" class="me-2 rounded-circle" width="82px" />
    </a>

    <!-- Mobile icons -->
    <div class="d-flex align-items-center d-lg-none ms-auto gap-3">
      <a href="#" id="openMobileSearch" class="text-white text-decoration-none">
        <i class="bi bi-search fs-4"></i>
      </a>
      <button class="navbar-toggler text-white border-0 bg-transparent p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <i class="bi bi-list text-white fs-1"></i>
      </button>
    </div>

    <!-- Collapse items -->
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0" id="mainCategories">
        <li class="nav-item">
          <a class="nav-link" href="#" data-category="skin">SKIN</a>
          <ul class="list-unstyled ps-3 collapse" id="submenu-skin"></ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-category="hair">HAIR</a>
          <ul class="list-unstyled ps-3 collapse" id="submenu-hair"></ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">BODY</a></li>
        <li class="nav-item"><a class="nav-link" href="#">BABY</a></li>
        <li class="nav-item"><a class="nav-link" href="#">PERSONAL</a></li>
        <li class="nav-item"><a class="nav-link" href="#">DEVICES</a></li>
        <li class="nav-item"><a class="nav-link" href="#">OFFERS</a></li>
      </ul>

      <!-- Desktop icons -->
      <div class="nav-icons d-none d-lg-flex align-items-center gap-3">
        <form action="shop.php" method="GET" class="me-3 mb-0">
          <input type="text" name="query" class="form-control form-control-sm rounded-pill px-3 py-2" placeholder="Search products..." />
        </form>
        <a href="favorites.php" class="text-white text-decoration-none"><i class="bi bi-heart fs-5"></i></a>
        <a href="cart.php" class="text-white text-decoration-none"><i class="bi bi-bag fs-5"></i></a>

        <!--  Guest buttons -->
       <div id="auth-links" class="d-flex gap-2">
  <a href="login.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Login</a>
  <a href="signup.php" class="btn btn-light btn-sm rounded-pill px-3">Sign Up</a>
</div>


      
      </div>
    </div>
  </div>
</nav>

<!-- ========== Mobile Search Bar ========== -->
<div id="mobileSearchBar" class="mobile-search-bar d-lg-none shadow-sm">
  <form action="shop.php" method="GET" class="d-flex align-items-center gap-2">
    <input type="text" name="query" class="form-control form-control-sm" placeholder="Search products..." />
    <button type="button" class="btn btn-outline-secondary btn-sm" id="closeMobileSearch">
      <i class="bi bi-x-lg"></i>
    </button>
  </form>
</div>

<!-- ========== Mega Menu (Desktop Only) ========== -->
<div id="megaMenu" class="bg-white border-top shadow-sm d-none position-absolute w-100" style="top:115px; left:0; z-index:9999;">
  <div class="container py-4">
    <div class="row" id="megaMenuContent"></div>
  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Custom JS -->
<script type="module" src="assets/js/nav.js"></script>
</body>
</html>
