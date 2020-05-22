<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientlevel'] == 1){
    header("Location: /project/index.php");
}
?>
<?php
// Build a drop-down menu using the select form using the $categories array then make it sticky
$catList = '<select name="categoryid" id="categoryid">';
foreach ($categories as $category) {
    $catList .= "<option value='$category[categoryid]'";
    if(isset($categoryId)){
        if($category['categoryid'] === $categoryId){
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
  <title>Add Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="../css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main class="formPage">

<h3>Please enter product information</h3>

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

<form action="../products/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="invName">Product Name</label>
            <input type="text" name="invName" id="invName" <?php if(isset($invName)){echo "value='$invName'";} ?> required>
        </div>        
        <div>
            <label for="invDescription">Product Discription</label>
            <input type="text" name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?> required>
        </div>   
        <div>
            <label for="invImage">Product Image</label>
            <input type="text" id="invImage" name="invImage" value="/project/images/no-image.png" readonly <?php if(isset($invImage)){echo "value='$invImage'";} ?> required>
        </div> 
        <div>
            <label for="invThumbnail">Product Thumbnail</label>
            <input type="Text" name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} ?> required>
        </div>
        <div>
            <label for="invPrice">Product Price (Up to 10 digets and 2 decimal places)</label>
            <input type="Text" name="invPrice" id="invPrice" placeholder="9.99" pattern="\d+(\.\d{2})?" <?php if(isset($invPrice) && $checkedPrice == 1){echo "value='$invPrice'";} ?> required>
        </div>
        <div>
            <label for="invStock">Product Stock</label>
            <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
        </div>
        <div>
            <label for="categoryId">Product Category</label>
            <?php
            echo $catList;
            ?>
        </div>
        <input type="submit" name="submit" id="prodbtn" class="button" value="Add Product">
        <input type="hidden" name="action" value="addProd">   
    </form>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>