<nav>
    <ul id="menu">
        <li><a href="index.php">Accueil</a></li>
        <?php
        if(!isset($_SESSION['id']))
        {
            ?><li><a href="connexion.php">Connexion</a></li>
            <?php
        }
        else
        {
            ?><li><a href="deconnexion.php">Deconnexion</a></li>
            <?php
        }
        ?>
        <li><a href="camera.php">Camera</a></li>
        <li><a href="galerie.php">Galerie</a></li>
    </ul>
</nav>