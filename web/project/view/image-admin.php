<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Image Managment | Acme, Inc.</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main>

   <h1>Image Managment</h1>

   <p>Welcome to the image managment page.  Please select a product in the drop down list below to get started.</p>

   <h2>Add New Product Image</h2>

    <?php
    if (isset($message)){
    echo $message;
    }
    ?>

    <form action="/project/uploads/" method="post" enctype="multipart/form-data">
        <label for="invItem">Product</label><br>
        <?php echo $prodSelect; ?><br><br>
        <label>Upload Image:</label><br>
        <input type="file" name="file1"><br>
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
    </form>

    <hr>

    <h2>Existing Images</h2>

    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>

    <?php
    if (isset($imageDisplay)){
    echo $imageDisplay;
    }
    ?>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>
<?php unset($_SESSION['message']); ?>