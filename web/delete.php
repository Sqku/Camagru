<?php

include("db_start.php");
include("debut.php");
include("header.php");
if (!isset($_SESSION['id']) || empty($_SESSION['id']))
{
    header('Location:connexion.php');
    die();
}

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    http_response_code(403);
    die();
}

$id = $_POST['id'];


if(!is_numeric($id))
{
    http_response_code(404);
    echo "Cette image n'existe pas";
    include("footer.php");
    die();
}

$query = $db->prepare("SELECT * FROM images WHERE id=? AND users_id=?");
$query->bindParam(1, $id, \PDO::PARAM_INT);
$query->bindParam(2, $_SESSION['id'], \PDO::PARAM_INT);
$query->execute();
$data = $query->fetch();

if ($data)
{

    $query3 = $db->prepare("DELETE FROM images WHERE id=?");
    $query3->execute(array($id));

    unlink("img/uploads/$id.png");
    echo "Vous avez bien supprimer le montage";
    $message = '<p>Cliquez <a href="./galerie.php">ici</a> pour aller à la galerie';
    echo $message;
}
else
{
    http_response_code(404);
    echo "Vous n'êtes pas autorisé à effectuer cette action";
    $message = '<p>Cliquez <a href="./galerie.php">ici</a> pour aller à l\'accueil';
    echo $message;
    include("footer.php");
    die();
}

include("fin.php");
?>