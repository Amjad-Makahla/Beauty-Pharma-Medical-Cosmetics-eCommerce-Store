<?php
require_once('auth.php');
check_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Monitoring Rounds</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="main-content">
  <h2 class="mb-4"><i class="bi bi-clock-history me-2"></i>Monitoring Rounds</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>Round ID</th>
          <th>Started At</th>
          <th>Ended At</th>
          <th>Success Count</th>
          <th>Failure Count</th>
          <th>Success Rate</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="rounds-body">
        <tr><td colspan="7" class="text-center py-4">Loading...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<script type="module" src="assets/js/rounds.js"></script>
</body>
</html>
