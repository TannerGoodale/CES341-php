<?php
// Controller for shopping cart activity week 03
// Template shopping cart / no credit card active

require_once '../week03/library/fakedb.php';

// Create or access a Session 
session_start();

// Create controll structure for dynamic site navigation
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {

  case 'getProdInfo':
    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $prodInfo = getProductInfoById($products, $id);

    $backToBrowse = "<a href=../week03/index.php>< Back to Browse</a>";

    include 'views/product-page.php';
    
  exit;

  case 'addToCart':

    $id = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

    $cartContent = array();
    array_push($cartContent, $id);

    $_SESSION['cartContent'] = $cartContent;

    $_SESSION['message'] = "<p class='red'>Successfully added to cart</p>";

    header("Location: ../week03/index.php?getProdInfo&id=$id");

  exit;

  default:

    $tnDisplay = buildProductTNDisplay($products);

  include 'views/browse.php';
}
?>