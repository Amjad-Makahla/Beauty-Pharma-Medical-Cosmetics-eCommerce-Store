<?php
require_once('config.php');

$brands = [];
$categories = [];
$price_ranges = [
  ["label" => "$0 - $10", "min" => 0, "max" => 10],
  ["label" => "$10 - $25", "min" => 10, "max" => 25],
  ["label" => "$25 - $50", "min" => 25, "max" => 50],
  ["label" => "$50 - $75", "min" => 50, "max" => 75],
  ["label" => "$75 - $100", "min" => 75, "max" => 100],
  ["label" => "$100 - $200", "min" => 100, "max" => 200],


];

$brandRes = $conn->query("SELECT DISTINCT brand FROM products WHERE status = 1 ORDER BY brand ASC");
while ($row = $brandRes->fetch_assoc()) {
  $brands[] = $row['brand'];
}

$catRes = $conn->query("SELECT id, name FROM categories WHERE status = 1 ORDER BY name ASC");
while ($row = $catRes->fetch_assoc()) {
  $categories[] = $row;
}

print_response(true, "Filter options fetched", [
  "brands" => $brands,
  "categories" => $categories,
  "price_ranges" => $price_ranges
]);
