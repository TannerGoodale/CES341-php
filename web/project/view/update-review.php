<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Edit Review</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="/project/css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/header.php'; ?>

</header>

<main>

    <h1>Edit Review</h1>

    <p>Use the form below to edit your review.</p>

    <?php
    if (isset($message)) {
    echo $message;
    }
    ?>

    <?php echo $reviewDisplay;?>

</main>

<footer>

    <?php include $_SERVER['DOCUMENT_ROOT'].'/project/modules/footer.php'; ?>

</footer>

</div>

</body>

</html>