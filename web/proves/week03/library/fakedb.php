<?php
// This page functions as a database and builder functions page.
// Ideally, a database would be used and you would make models that call from the database.
// Also, a function page should be seperate as well.

// prod Id, name, discription, price, img location...

$products = array (
    array ( "id"=>"1", "name"=>"Spring Apple", "disc"=>"A wonderful spring time herbal tea. Made from all natural dried apple, lemon peels, hibiscus flowers and other fresh friuts.", "price"=>"$4.00", "img-location"=>"assests/apple.jpg" ),
    array ( "id"=>"2", "name"=>"Dewy Cherry", "disc"=>"A sweet and tart herbal blend of cherries, apples, orange peels, rose gips and hibiscus flowers.", "price"=>"$4.00", "img-location"=>"assests/cherry.jpg" ),
    array ( "id"=>"3", "name"=>"Green Rooibos", "disc"=>"A natural herbal tea that's similar in taste to traditional green tea.", "price"=>"$3.00", "img-location"=>"assests/green-rooibos.jpg" ),
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
        $tnd .= "<a href='../week03/index.php?action=getProdInfo&id=$prodId'><img class='tn' src='$img'></a>";
        $tnd .= "<a href='../week03/index.php?action=getProdInfo&id=$prodId' class='name'>$prodName</a>";
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
            $prodInfo = "<div id='container-fluid'>";
            $prodInfo .= "<h1>$prodName</h1>";
            $prodInfo .= "<div class='side-by-side'>";
            $prodInfo .= "<img src='$img'>";
            $prodInfo .= "<p>$prodDisc</p>";
            $prodInfo .= "</div>";
            $prodInfo .= "<span>$prodPrice</span>";
            $prodInfo .= "<form action='index.php' method='POST'>";
            $prodInfo .= "<input type='hidden' name='prodId' value='$prodId'>";
            $prodInfo .= "<input type='hidden' name='action' value='addToCart'>";
            $prodInfo .= "<input name='submit' type='submit' value='Add To Cart'>";
            $prodInfo .= "</form>";
            $prodInfo .= "</div>";
            return $prodInfo;
        } 
    }
}

function getProductSummeryById($products, $id){
    foreach($products as $prod){
        if($prod['id']==$id){
            // Define data
            $prodId = $prod['id'];
            $prodName = $prod['name'];
            $prodDisc = $prod['disc'];
            $prodPrice = $prod['price'];
            $img = $prod['img-location'];
            // Build body
            $prodInfo = "<div id='container-fluid'>";
            $prodInfo .= "<a href='../week03/index.php?action=getProdInfo&id=$prodId'><img class='tn' src='$img'></a>";
            $prodInfo .= "<a href='../week03/index.php?action=getProdInfo&id=$prodId'>$prodName</a>";
            $prodInfo .= "<p>$prodPrice</p>";
            $prodInfo .= "<form action='index.php' method='POST'>";
            $prodInfo .= "<input type='hidden' name='prodId' value='$prodId'>";
            $prodInfo .= "<input type='hidden' name='action' value='removeFromCart'>";
            $prodInfo .= "<input name='submit' type='submit' value='Remove'>";
            $prodInfo .= "</form>";
            $prodInfo .= "</div>";
            return $prodInfo;
        } 
    }
}

function checkOutForm(){
    $f = "<form action='index.php' method='POST'>";
    $f .= "<input type='hidden' name='action' value='confirm'>";
    $f .= "<label for='fname'>First name:</label>";
    $f .= "<input type='text' id='fname' name='fname'>";
    $f .= "<label for='lname'>Last name:</label>";
    $f .= "<input type='text' id='lname' name='lname'>";
    $f .= "<label for='street'>Street name and number:</label>";
    $f .= "<input type='text' id='street' name='street'>";
    $f .= "<label for='state'>State:</label>";
    $f .= "<input type='text' id='state' name='state'>";
    $f .= "<label for='zip'>Zip Code:</label>";
    $f .= "<input type='text' id='zip' name='zip'>";
    $f .= "<input type='submit' name='action' value='Check Out'>";
    $f .= "</form>";
    return $f;
}
?>