<?php
include("db_start.php");

$id = $_GET['id'];

if (!empty($_POST) && isset($_SESSION['pseudo']))
{
    $comment = $_POST["commentaire"];
    $userid = $_SESSION["id"];

    try {
        $query = $db->prepare('INSERT INTO commentaires (commentaire, users_id, images_id)
VALUES (:comment, :users, :img)');
        $query->bindValue(':comment', $comment, PDO::PARAM_STR);
        $query->bindValue(':users', $userid, PDO::PARAM_INT);
        $query->bindValue(':img', $id, PDO::PARAM_INT);
        $query->execute();
    } catch (PDOException $e) {
        echo 'Pdo error: ' . $e->getMessage();
        die();
    }
}
$query->CloseCursor();

header('Location:apercu.php');

?>