<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tachyons/css/tachyons.min.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div id="container" class="measure-wide">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/header.php';?>
        </header>
        <main>
            <section>
                <h1>Welcome to The Project Portal</h1>
                <p>Please select the project you wish to see below.</p>
                <div id="projectList">
                    <ul>
                        <li><a href="../misc/week03/teamactivity03-controller.php">Team Activity Week 03</a></li>
                        <li><a herf="http://cryptic-sands-03658.herokuapp.com/proves/week03/">Shopping Cart (Rough and incompleate)</a></li>
                        <li><a href="project/">PHP Project</a></li>
                    </ul>
                </div>
            </section>
        </main>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'].'/modules/footer.php';?>
        </footer>
    </div>
</body>
</html>