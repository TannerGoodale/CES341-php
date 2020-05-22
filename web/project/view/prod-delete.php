<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientlevel'] == 1){
    header("Location: /project/index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php if(isset($prodInfo['invname'])){ 
       echo "Delete $prodInfo[invname] ";} 
       elseif(isset($invName)) { echo $invName; }?> 
       | Acme, Inc</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main class="formPage">

<h3><?php if(isset($prodInfo['invName'])){ 
       echo "Delete $prodInfo[invName] ";} 
       elseif(isset($invName)) { echo $invName; }?></h3>

<p>Confirm Product Deletion. The delete is permanent.</p>

<?php
if (isset($message)) {
 echo $message;
}
?>

<form action="/project/products/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="invName">Product Name</label>
            <input type="text" name="invName" id="invName" <?php if(isset($invName)){ echo "value='$invName'"; } 
            elseif(isset($prodInfo['invName'])) {
            echo "value='$prodInfo[invName]'"; }?> required>
        </div>        
        <div>
            <label for="invDescription">Product Discription</label>
            <input type="text" name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}
            elseif(isset($prodInfo['invDescription'])) {
            echo "value='$prodInfo[invDescription]'"; } ?> required>
        </div>   
        <input type="submit" name="submit" id="prodbtn" class="button" value="Delete Product">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="deleteProd">
        <input type="hidden" name="invId" id="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">   
    </form>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>