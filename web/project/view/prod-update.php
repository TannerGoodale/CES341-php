<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientlevel'] == 1){
    header("Location: ../index.php");
}
?>
<?php
// Build the categories option list
$catList = '<select name="categoryId" id="categoryid">';
$catList .= "<option>Choose a Category</option>";
foreach ($categories as $category) {
 $catList .= "<option value='$category[categoryid]'";
 if(isset($categoryId)){
  if($category['categoryid'] === $categoryId){
   $catList .= ' selected ';
  }
 } elseif(isset($prodInfo['categoryid'])){
  if($category['categoryid'] === $prodInfo['categoryid']){
   $catList .= ' selected ';
  }
 }
$catList .= ">$category[categoryname]</option>";
}
$catList .= '</select>';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php if(isset($prodInfo['invname'])){ 
       echo "Modify $prodInfo[invname] ";} 
       elseif(isset($invName)) { echo $invName; }?> 
       | SteeptClub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main class="formPage">

<h3><?php if(isset($prodInfo['invname'])){ 
       echo "Modify $prodInfo[invname] ";} 
       elseif(isset($invName)) { echo $invName; }?></h3>

<?php
if (isset($message)) {
 echo $message;
}
?>

<?php
if (isset($priceMessage)) {
echo $priceMessage;
}
?>

<form action="/project/products/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="invName">Product Name</label>
            <input type="text" name="invName" id="invName" <?php if(isset($invName)){ echo "value='$invName'"; } 
            elseif(isset($prodInfo['invname'])) {
            echo "value='$prodInfo[invname]'"; }?> required>
        </div>        
        <div>
            <label for="invDescription">Product Discription</label>
            <input type="text" name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}
            elseif(isset($prodInfo['invdescription'])) {
            echo "value='$prodInfo[invdescription]'"; } ?> required>
        </div>   
        <div>
            <label for="invPrice">Product Price (Up to 10 digets and 2 decimal places)</label>
            <input type="Text" name="invPrice" id="invPrice" placeholder="9.99" pattern="\d+(\.\d{2})?" <?php if(isset($invPrice) && $checkedPrice == 1){echo "value='$invPrice'";}
            elseif(isset($prodInfo['invprice'])) {
            echo "value='$prodInfo[invprice]'";} ?> required>
        </div>
        <div>
            <label for="invStock">Product Stock</label>
            <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} 
            elseif(isset($prodInfo['invstock'])) {
            echo "value='$prodInfo[invstock]'";} ?> required>
        </div>
        <div>
            <label for="categoryId">Product Category</label>
            <?php
            echo $catList;
            ?>
        </div>
        <input type="submit" name="submit" id="prodbtn" class="button" value="Update Product">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="updateProd">
        <input type="hidden" name="invId" id="invId" value="<?php if(isset($prodInfo['invid'])){ echo $prodInfo['invid'];} 
        elseif(isset($invId)){ echo $invId; } ?>">   
    </form>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>