<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SteeptClub Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" media="screen" href="css/main.css">
</head>

<body>

<div id="container">

<header>

    <?php include 'modules/header.php'; ?>

</header>

<main class="center">

    <section>
        <h1>Welcome to SteeptClub</h1>
        
        <p>
            Family owned and operated, we started SteeptClub in 2019 as a way to share one of our many passions, top quality herbal tea.
        <p>

        <section class="center">
            <h3>Our Favorates for the Season</h3>
            <ul id="prod-display">
                <li>
                <a href='products/index.php?action=getProdInfo&invId=6'><img src='/project/images/products/sweet-spring-herbal-tea-tn.jpg' alt='Image of Sweet Spring Blend on SteeptClub.com'></a>
                <hr>
                <a href='products/index.php?action=getProdInfo&invId=6'><h4>Sweet Spring Blend</h4></a>
                <span>$4.00</span>
                </li>
                <li>
                <a href='products/index.php?action=getProdInfo&invId=1'><img src='/project/images/products/african-delight-loose-leaf-tea-tn.jpg' alt='Image of African Delight Blend on SteeptClub.com'></a>
                <hr>
                <a href='products/index.php?action=getProdInfo&invId=1'><h4>African Delight Blend</h4></a>
                <span>$4.00</span>
                </li>
                <li>
                <a href='products/index.php?action=getProdInfo&invId=7'><img src='/project/images/products/green-rooibos-loose-leaf-tea-tn.jpg' alt='Image of Pure Green Rooibos on SteeptClub.com'></a>
                <hr>
                <a href='products/index.php?action=getProdInfo&invId=7'><h4>Green Rooibos</h4></a>
                <span>$3.00</span>
                </li>
                <li>
                <a href='products/index.php?action=getProdInfo&invId=2'><img src='/project/images/products/apple-loose-leaf-tea-tn.jpg' alt='Image of Apple Blend on SteeptClub.com'></a>
                <hr>
                <a href='products/index.php?action=getProdInfo&invId=2'><h4>Apple Blend</h4></a>
                <span>$3.00</span>
                </li>
            </ul>
            </section>
    
    </section>


</main>

<footer>

    <?php include 'modules/footer.php'; ?>

</footer>

</div>

</body>

</html>