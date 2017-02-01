<!--<link rel="stylesheet" media="screen" type="text/css" title="style" href="css/header.css"/>-->
<header class="header">
    <a href="#" class="menu_icon" id="menu_js"></a>
    <a href="index.php" class="logo">Camagru</a>
    <nav class="menu">
        <a href="index.php">Accueil</a>
            <?php
                if(!isset($_SESSION['id']))
                {
                    ?><a href="connexion.php">Connexion</a>
                <?php
                }
                else
                {
                    ?><a href="deconnexion.php">Deconnexion</a>
                    <?php
                }
            ?>
        <a href="camera.php">Camera</a>
        <a href="galerie.php">Galerie</a>
    </nav>
</header>