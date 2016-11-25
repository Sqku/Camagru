<?php
include("db_start.php");
include("debut.php");
include("header.php");
include("menu.php");

?>



<?php

$id = $_GET['id'];

$query=$db->prepare('SELECT id FROM images ORDER BY date DESC');
$query->execute();
$data=$query->fetchAll();

$query->CloseCursor();
?>

<img src="img/uploads/<?=$id?>.png">


<form action="commentaire.php" method="post">
    <textarea name="commentaire" style="width:450px;height:150px;"></textarea>
    <input type="submit" value="commenter">
</form>




