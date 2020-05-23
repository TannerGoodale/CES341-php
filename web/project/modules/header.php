<!-- Section for the header and navigation, dynamic php page section. -->
<div id="top">
    <a id="logoLink" href="/project/" title="The Home page for SteeptClub.com, the home of Primuim Herbal Teas.">
        <img id="logo" src="/project/images/site/logo.gif" alt="Logo for SteeptClub.com, the home of Primuim Herbal Teas.">
    </a>

    <div class='over-under'>
        <?php
        if($_SESSION){
            if($_SESSION['loggedin']){
                $userFirstName = $_SESSION['clientData']['clientfirstname'];
                echo "<a href='/project/accounts/index.php'><span class='welcome'>Welcome $userFirstName</span></a>";
            }
        }
        ?>

        <?php
        if($_SESSION){
            if(!$_SESSION['loggedin']){
            echo'<a href="/project/accounts/index.php?action=Login" title="Account portal, log into your SteeptClub account"><img id="accountGif" src="http://cryptic-sands-03658.herokuapp.com/project/images/site/account.gif" alt="Account folder icon">
                <span>My Account</span>
                </a>';
            }
            elseif($_SESSION['loggedin']){
                echo'<a href="/project/accounts/index.php?action=logout" title="Log out of your account">
                <span>Logout</span>
                </a>';
            }
        }else{
            echo'<a href="/project/accounts/index.php?action=Login" title="Account portal, log into your acme account"><img id="accountGif" src="http://cryptic-sands-03658.herokuapp.com/project/images/site/account.gif" alt="Account folder icon">
                <span>My Account</span>
                </a>';
        }
        ?>
    </div>
    
    
</div>

<nav id="page-nav">
    <!--<ul>
        <li class="active"><a class="active" href="/" title="Visit the acme home page">Home</a></li>
        <li><a href="/" title="Visit the acme cannon page to see our selection of oversized cannons">Cannon</a></li>
        <li><a href="/" title="Visit the acme explosives page to see our selection of high powered explosives">Explosive</a></li>
        <li><a href="/" title="Visit the acme misc page to see all of our odds and ends">Misc</a></li>
        <li><a href="/" title="Visit the acme rocket page to see all of our rockets">Rocket</a></li>
        <li><a href="/" title="Visit the acme trap page to see all of our razor sharp traps">Trap</a></li>
    </ul>-->
    <?php echo $navList; ?>
</nav>