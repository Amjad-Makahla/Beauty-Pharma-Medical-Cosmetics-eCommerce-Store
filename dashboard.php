<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Monitoring Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include("sidebar.php"); ?>

<!-- Main Content -->
<div class="main-content">
  <h2 class="mb-4"><i class="bi bi-bar-chart-steps me-2"></i>Monitoring Dashboard</h2>

  <div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-4">
      <div class="card p-4">
        <h6>Total URLs</h6>
        <p class="fs-3 fw-bold" id="total-urls">0</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card p-4">
        <h6>Total Monitoring Rounds</h6>
        <p class="fs-3 fw-bold" id="total-rounds">0</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card p-4">
        <h6>7-Day Uptime Rate</h6>
        <p class="fs-3 fw-bold text-success" id="uptime-rate">--%</p>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-4">
      <div class="card p-4">
        <h6>Average Latency</h6>
        <p class="fs-4 fw-semibold" id="avg-latency">-- ms</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card p-4">
        <h6>Worst Latency</h6>
        <p class="fs-4 fw-semibold text-danger" id="worst-latency">-- ms</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card p-4">
        <h6>Last Run Time</h6>
        <p class="fs-5" id="last-run">--</p>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    <div class="col-md-6">
      <h5><i class="bi bi-speedometer2 me-2"></i>Status Distribution</h5>
      <canvas id="statusChart" height="200"></canvas>
    </div>
    <div class="col-md-6">
      <h5><i class="bi bi-stopwatch me-2"></i>Top 3 Slowest URLs</h5>
      <ul id="slowest-urls" class="list-group"></ul>
    </div>
  </div>

  <h5 class="mb-3"><i class="bi bi-clock-history me-2"></i>Latest Monitoring Results</h5>
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead class="table-light">
        <tr>
          <th>URL</th>
          <th>Status</th>
          <th>HTTP</th>
          <th>Latency</th>
          <th>Checked At</th>
        </tr>
      </thead>
      <tbody id="results-body">
        <tr><td colspan="5" class="text-center py-4">Loading...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<script type="module" src="assets/js/dashboard.js"></script>

</body>
</html>