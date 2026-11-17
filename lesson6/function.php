<?php

require_once __DIR__ . "/data.php";

function calculateInventoryValue($product)
{
  return $product['quantity'] * $product['unitCost'];
}

function calculateTotalInventoryValue($products)
{
  $total = 0;
  foreach ($products as $product) {
    $total += calculateInventoryValue($product);
  }
  return $total;
}

function calculatePotentialRevenue($products)
{
  $total = 0;
  foreach ($products as $product) {
    $total += $product['quantity'] * $product['sellingPrice'];
  }
  return $total;
}

function calculatePotentialGrossProfit($products)
{
  return calculatePotentialRevenue($products) - calculateTotalInventoryValue($products);
}

function getStockStatus($product)
{
  $stockStatus = "";
  if ($product['quantity'] <= 0) {
    $stockStatus = "Out of stock";
  } elseif ($product['quantity'] <= $product['lowStockThreshold']) {
    $stockStatus = "Low stock";
  } else {
    $stockStatus = "In stock";
  }
  return $stockStatus;
}

function findMostExpensiveProduct($products)
{
  $mostExpensive = $products[0];
  foreach ($products as $product) {
    if ($product['sellingPrice'] > $mostExpensive['sellingPrice']) {
      $mostExpensive = $product;
    }
  }
  return $mostExpensive;
}

function findLowestStockProduct($products)
{
  $lowestStock = $products[0];
  foreach ($products as $product) {
    if ($product['quantity'] < $lowestStock['quantity']) {
      $lowestStock = $product;
    }
  }
  return $lowestStock;
}

function calculateAverageUnitCost($products)
{
  $totalUnitCost = 0;
  foreach ($products as $product) {
    $totalUnitCost += $product['unitCost'];
  }
  $avgUnitCost = $totalUnitCost / count($products);
  return $avgUnitCost;
}

function countLowAndOutStockProducts($products)
{
  $counter = ["lowCounter" => 0, "outCounter" => 0];

  foreach ($products as $product) {
    $stockStatus = getStockStatus($product);
    if ($stockStatus === "Low stock") {
      $counter["lowCounter"] += 1;
    } elseif ($stockStatus === "Out of stock") {
      $counter["outCounter"] += 1;
    }
  }
  return $counter;
}
