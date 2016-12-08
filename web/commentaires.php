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

        $query2 = $db->prepare("SELECT images.id AS image_id, users.* FROM images LEFT JOIN users ON users.id = images.users_id WHERE images.id = $id");
        $query2->execute();
        $data2 = $query2->fetch(\PDO::FETCH_ASSOC);

        $email = $data2['email'];

        $sujet = "nouveau commentaire" ;
        $entete = "From: camagru" ;
        $message = 'Bonjour '.$data2['user_name'].' ,
 
        Vous venez de recevoir un nouveau commentaire.
        
        Pour le voir, veuillez cliquer sur le lien ci dessous
        ou copier/coller dans votre navigateur internet.
         
        '.$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/apercu.php?id='.$id.'
         
         
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';


        mail($email, $sujet, $message, $entete);




    } catch (PDOException $e) {
        echo 'Pdo error: ' . $e->getMessage();
        die();
    }
}
$query->CloseCursor();

header('Location:apercu.php?id='.$id);

?>