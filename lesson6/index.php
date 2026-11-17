<?php
require_once __DIR__ . "/data.php";
require __DIR__ . "/function.php";

$mostExpensive = findMostExpensiveProduct($products);
$lowestStock = findLowestStockProduct($products);
$counter = countLowAndOutStockProducts($products);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StockPilot</title>
  <style>
    .sumary {
      display: flex;
      align-items: center;
      justify-content: space-around;
    }
  </style>
</head>

<body>
  <div class="sumary">
    <div class="card">
      <p>Total Inventory Cost</p>
      <p>$<?= number_format(calculateTotalInventoryValue($products), 2) ?></p>
    </div>
    <div class="card">
      <p>Potential Revenue</p>
      <p>$<?= number_format(calculatePotentialRevenue($products), 2) ?></p>
    </div>
    <div class="card">
      <p>Potential Gross Profit</p>
      <p>$<?= number_format(calculatePotentialGrossProfit($products), 2) ?></p>
    </div>
    <div class="card">
      </p>Average Unit Cost</p>
      <p>$<?= number_format(calculateAverageUnitCost($products), 2) ?></p>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>PRODUCT</th>
        <th>QTY</th>
        <th>VALUE</th>
        <th>STATUS</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></td>
          <td><?= htmlspecialchars($product['quantity'], ENT_QUOTES, 'UTF-8') ?></td>
          <td>$<?= number_format(calculateInventoryValue($product), 2) ?></td>
          <td><?= htmlspecialchars(getStockStatus($product), ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="report">
    <div class="card">
      <p>Most Expensive Product</p>
      <p><?= htmlspecialchars($mostExpensive['name'] . ' --$' . number_format($mostExpensive['sellingPrice'], 2), ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <div class="card">
      <p>Lowest Stock Product</p>
      <p>
      <p><?= htmlspecialchars($lowestStock['name'] . ' -- ' . $lowestStock['quantity'] . ' units', ENT_QUOTES, 'UTF-8') ?></p>
      </p>
    </div>
    <div class="card">
      <p>Low Stock Products</p>
      <p><?= htmlspecialchars($counter['lowCounter'], ENT_QUOTES, 'utf-8') ?></p>
    </div>
    <div class="card">
      <p>Out of Stock Products</p>
      <p><?= htmlspecialchars($counter['outCounter']) ?></p>
    </div>
  </div>
</body>

</html>