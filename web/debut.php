 <html>
    <head>
        <!DOCTYPE html>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" media="screen" type="text/css" title="style" href="css/header.css"/>
        <link rel="stylesheet" media="screen" type="text/css" title="style" href="css/style.css"/>
        <link rel="stylesheet" media="screen" type="text/css" title="style" href="css/fontello.css"/>
        <link rel="stylesheet" media="screen" type="text/css" title="style" href="css/grid_test.css"/>
        <?php
            $lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:3;
            $id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
            $pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
            include("functions.php");
            include("constants.php");
        ?>
    </head>