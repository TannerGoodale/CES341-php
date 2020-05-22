<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="http://cryptic-sands-03658.herokuapp.com/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/header.php'; ?>

</header>

<main>

    <h1><?php echo $categoryName; ?> Products</h1>

    <?php if(isset($message)){
    echo $message; } 
    ?>

    <?php if(isset($prodDisplay)){ 
    echo $prodDisplay; 
    } ?>

</main>

<footer>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>