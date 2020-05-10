<?php
// Controller for shopping cart activity week 03
// Template shopping cart / no credit card active

require_once '../week03/library/fakedb.php';

// Create or access a Session 
session_start();

if(!isset($_SESSION['cartContent'])) {
    $_SESSION['cartContent'] = array();
}

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

    array_push($_SESSION['cartContent'],$id);

    $_SESSION['message'] = "<p class='red'>Successfully added to cart</p>";

    header("Location: ../week03/index.php?getProdInfo&id=$id");

  exit;

  case 'cart':

    if($_SESSION['cartContent'] == TRUE){
        $cartData = "<div>";
        for($i = 0; $i < count($_SESSION['cartContent']); $i++ ){
            $idTemp = $_SESSION['cartContent'][$i];
            $cartData .= getProductSummeryById($products, $idTemp);
        }
        $cartData .= "</div>";
        } else {
            $cartData = "<p>There is nothing in your cart.  Click <a href='../week03/index.php'>here</a> to browse.";
        }

    $backToBrowse = "<a href=../week03/index.php>< Back to Browse</a>";

    include 'views/cart.php';

  exit; 

  case 'removeFromCart':

    $id = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

    $key = array_search($id, $_SESSION['cartContent']);

    unset($_SESSION['cartContent'][$key]);

    header("Location: ../week03/index.php?cart");

  exit;  

  default:

    $tnDisplay = buildProductTNDisplay($products);

  include 'views/browse.php';
}
?>