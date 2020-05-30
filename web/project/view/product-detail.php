<?php
if (isset($_SESSION['message'])) {
    $reviewMssageGood = $_SESSION['message'];
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php if(isset($prodName)){echo $prodName;}?> | SteeptClub</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main>

    <div id="productDisplayPage">

    <?php
    if (isset($message)) {
    echo $message;
    }
    ?>

    <?php echo $productDisplay;?>

    </div>

    <hr>

    <h3 class="bump-right">Product thumbnails</h3>

    <?php echo $tnDisplay;?>

    <hr>

    <h3 class="bump-right">Product Reviews</h3>

    <?php 
    if(isset($preReviewCheck)){echo $preReviewCheck;}
    if(isset($reviewForm)){echo  $reviewForm;}
    ?> 

    <?php if(isset($reviewMssageGood)){echo $reviewMssageGood;}?>

    <?php if(isset($rd)){echo $rd;}else{echo $reviewMessage;} ?>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>
<?php
if (isset($_SESSION['message'])){unset($_SESSION['message']);}
?>