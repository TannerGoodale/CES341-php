<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div id="container">
        <header>
            <?php include 'modules/header.php';?>
        </header>
        <main>
            <section>
                <?php if(isset($backToBrowse)){echo $backToBrowse;} ?>
                <?php echo $prodInfo; ?>
                <?php if(isset($_SESSION['message'])){$_SESSION['message'];} ?>
            </section>
        </main>
        <footer>
            <?php include 'modules/footer.php';?>
        </footer>
    </div>
</body>
</html>