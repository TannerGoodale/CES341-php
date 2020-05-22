<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] == 1){
    header("Location: http://cryptic-sands-03658.herokuapp.com/project/index.php");
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Product Managment Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="http://cryptic-sands-03658.herokuapp.com/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/header.php'; ?>

</header>

<main class="prodPage">

    <h2>Welcome to the product managment page</h2>

    <div><a href="http://cryptic-sands-03658.herokuapp.com/project/products/index.php?action=AddCat">Category Creation</a></div>

    <div><a href="http://cryptic-sands-03658.herokuapp.com/project/products/index.php?action=AddProd">Product Creation</a></div>


    <?php
    if (isset($message)) { 
    echo $message; 
    } 
    if (isset($categoryList)) { 
    echo '<h2>Products By Category</h2>'; 
    echo '<p>Choose a category to see those products</p>'; 
    echo $categoryList; 
    }
    ?>
    <noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="productsDisplay"></table>

</main>

<footer>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/footer.php'; ?>

</footer>

</div>

<script src="http://cryptic-sands-03658.herokuapp.com/project/js/products.js"></script>

</body>

</html>
<?php unset($_SESSION['message']); ?>