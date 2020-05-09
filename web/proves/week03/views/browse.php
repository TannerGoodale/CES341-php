<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broswe Items</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div id="container">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'].'../modules/header.php';?>
        </header>
        <main>
            <section>
                <?php echo $tnDisplay; ?>
            </section>
        </main>
        <footer>
        <?php include $_SERVER['DOCUMENT_ROOT']. '../modules/footer.php';?>
        </footer>
    </div>
</body>
</html>