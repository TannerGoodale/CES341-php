<?php
if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] == 1){
    header("Location: http://cryptic-sands-03658.herokuapp.com/project/index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Add Category</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="http://cryptic-sands-03658.herokuapp.com/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/header.php'; ?>

</header>

<main class="formPage">

    <h3>Enter the name of the new category</h3>

    <!-- Add messages from controller as needed -->
    <?php
    if (isset($message)) {
    echo $message;
    }
    ?>

    <form action="http://cryptic-sands-03658.herokuapp.com/project/products/index.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="categoryName">New Category Name</label>
            <input type="text" name="categoryName" id="categoryName" required>
        </div>
        <input type="submit" name="submit" id="catbtn" class="button" value="Add Category">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="addCat">
    </form>

</main>

<footer>

    <?php include 'http://cryptic-sands-03658.herokuapp.com/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>