<head>
    <!DOCTYPE html>
    <meta charset="utf-8" />
    <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css"/>
    <link rel="stylesheet" media="screen" type="text/css" title="style" href="/css/fontello.css"/>
    <title>Camagru</title>
    <?php
        $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:3;
        $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
        $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
        include("functions.php");
        include("constants.php");
    ?>
</head>