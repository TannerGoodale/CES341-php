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
    
    switch ($id) {
        case '1':
            $prod = array ( "id"=>"1", "name"=>"Spring Apple", "disc"=>"A wonderful spring time herbal tea. Made from all natural dried apple, lemon peels, hibiscus flowers and other fresh friuts.", "price"=>"$4.00", "img-location"=>"../assests/apple.jpg" );
            $prodId = $prod['id'];
            $prodName = $prod['name'];
            $prodDisc = $prod['disc'];
            $prodPrice = $prod['price'];
            $img = $prod['img-location'];
            // Build body
            $prodInfo = "<div id='container'>";
            $prodInfo .= "<h1>$prodName</h1>";
            $prodInfo .= "<div class='side-by-side'>";
            $prodInfo .= "<img src='$img'>";
            $prodInfo .= "<p>$prodDisc</p>";
            $prodInfo .= "</div>";
            $prodInfo .= "<span>$prodPrice</span>";
            $prodInfo .= "<form action='../index.php' method='GET'>";
            $prodInfo .= "<input type='hidden' name='prodId' value='$prodId'>";
            $prodInfo .= "<input type='hidden' name='action' value='add'>";
            $prodInfo .= "<input name='submit' type='submit' value='Add To Cart'>";
            $prodInfo .= "</form>";
            $prodInfo .= "</div>";
    }

    include 'views/product-page.php';
    
  exit;

  default:

    $tnDisplay = buildProductTNDisplay($products);

  include 'views/browse.php';
}
?>