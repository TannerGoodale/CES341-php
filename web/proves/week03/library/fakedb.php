<?php

// prod Id, name, discription, price, img location...

$products = array (
    array ( "id"=>"1", "name"=>"Spring Apple", "disc"=>"A wonderful spring time herbal tea. Made from all natural dried apple, lemon peels, hibiscus flowers and other fresh friuts.", "price"=>"$4.00", "img-location"=>"../assests/apple.jpg" ),
    array ( "id"=>"2", "name"=>"Dewy Cherry", "disc"=>"A sweet and tart herbal blend of cherries, apples, orange peels, rose gips and hibiscus flowers.", "price"=>"$4.00", "img-location"=>"../assests/cherry.jpg" ),
    array ( "id"=>"3", "name"=>"Green Rooibos", "disc"=>"A natural herbal tea that's similar in taste to traditional green tea.", "price"=>"$3.00", "img-location"=>"../assests/green-rooibos.jpg" ),
);

// Bulder functions

function buildProductTNDisplay($products){
    $tnd = '<div id="prodDisplay">';
    foreach($products as $prodTN){
        // Define data for the loop
        $prodId = $prodTN['id'];
        $prodName = $prodTN['name'];
        $prodDisc = $prodTN['disc'];
        $prodPrice = $prodTN['price'];
        $img = $prodTN['img-location'];
        // Build body using defined data
        $tnd .= "<div class='container'>";
        $tnd .= "<img srec='$img'>";
        $tnd .= "<a href='../week03/products/index.php?action=getProdInfo&invId=$prodId' class='name'>$prodName</a>";
        $tnd .= "</div>";
    }
    $tnd .= "</div>";
    return $tnd;
}

function getProductInfoById($products, $id){
    foreach($products as $prod){
        if($prod['id']==$id){
            // Define data
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
            return $prodInfo;
            exit;
        } else {
            $error = "<p>An error has occoured.</p>";
            return $error;
            exit;
        }
    }
}
?>