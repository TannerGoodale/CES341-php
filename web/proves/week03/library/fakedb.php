<?php

// prod Id, name, discription, price, img location...

$products = array (
    array ( "id"=>"1", "name"=>"Spring Apple", "disc"=>"A wonderful spring time herbal tea. Made from all natural dried apple, lemon peels, hibiscus flowers and other fresh friuts.", "price"=>"$4.00", "img-location"=>"../assests/apple.jpg" ),
    array ( "id"=>"2", "name"=>"Dewy Cherry", "disc"=>"A sweet and tart herbal blend of cherries, apples, orange peels, rose gips and hibiscus flowers.", "price"=>"$4.00", "img-location"=>"../assests/cherry.jpg" ),
    array ( "id"=>"3", "name"=>"Green Rooibos", "disc"=>"A natural herbal tea that's similar in taste to traditional green tea.", "price"=>"$3.00", "img-location"=>"../assests/green-rooibos.jpg" ),
);

function buildProductTNDisplay($products){
    $tnd = '<div id="prodDisplay">';
    foreach($products as $prodTN){
        // Define data for the loop
        $prodId = $prodTN['id'];
        $prodName = $prodTN['name'];
        $prodDisc = $prodTN['disc'];
        $prodPrice = $prodTN['price'];
        $img = $prodTN['ing-location'];
        // Build body using defined data
        $tnd .= "<img srec='/assests/$img'>";
        $tnd .= "<span class='name'>$prodName</span>";
    }
    $tnd .= "</div>";
    return $tnd;
}