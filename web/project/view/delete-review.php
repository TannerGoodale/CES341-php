<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main>

    <h1>Delete Review</h1>

    <h3 class="red">Deleting a review is permanint, are you sure you want to delete it?</h3>

    <?php echo $reviewDisplay;?>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>