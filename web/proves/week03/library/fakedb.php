<!-- Mock up of info dump -->
<!-- array(1) { [0]=> array(13) { 
["invId"]=> string(1) "7" 
["invName"]=> string(14) "Koenigsegg CCX" 
["invDescription"]=> string(138) "This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph." 
["invImage"]=> string(34) "/acme/images/products/no-image.png" 
["invThumbnail"]=> string(34) "/acme/images/products/no-image.png" 
["invPrice"]=> string(9) "500000.00" 
["invStock"]=> string(1) "1" 
["invSize"]=> string(5) "25000" 
["invWeight"]=> string(4) "3000" 
["invLocation"]=> string(8) "San Jose" 
["categoryId"]=> string(1) "3" 
["invVendor"]=> string(10) "Koenigsegg" 
["invStyle"]=> string(5) "Metal" } 
} -->

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