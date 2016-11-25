<?php
include("db_start.php");
include("debut.php");
include("header.php");
include("menu.php");

?>

<head>
<!--    <script type="text/javascript" src="zoombox/jquery.js"></script>-->
<!--    <script type="text/javascript" src="zoombox/zoombox.js"></script>-->
<!--    <link rel="stylesheet" type="text/css" href="theme/style.css" />-->
<!--    <link href="zoombox/zoombox.css" rel="stylesheet" type="text/css" media="screen" />-->
</head>

<body>
<?php
if(isset($erreur)){
    echo $erreur;
}

?>

<?php

$query=$db->prepare('SELECT * FROM images ORDER BY date DESC');
$query->execute();
$data=$query->fetchAll();


foreach($data as $img) : ?>

<div class="min">
    <a href="apercu.php?id=<?=$img['id']?>">
<!--        <a href="img/uploads/--><?//=$img['id']?><!--.png">-->
        <img src="img/uploads/<?=$img['id']?>.png" alt="<?=$img['id']?>">
    </a>
</div>

<?php endforeach;
$query->CloseCursor();
?>

</body>