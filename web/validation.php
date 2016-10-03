<?php

include("db_start.php");

$login = $_GET['log'];
$cle = $_GET['cle'];

$query = $db->prepare("SELECT cle,actif FROM users WHERE user_name like :login ");
if($query->execute(array(':login' => $login)) && $row = $query->fetch())
{
    $clebd = $row['cle'];
    $actif = $row['actif'];
}

if($actif == '1')
{
    echo "Votre compte est déjà actif !";
}
else
{
    if($cle == $clebd)
    {
        echo "Votre compte a bien été activé !";

        $cle = '';
        $query = $db->prepare("UPDATE users SET actif = 1, cle = :cleVide WHERE user_name like :login ");
        $query->bindParam(':cleVide', $cle);
        $query->bindParam(':login', $login);
        $query->execute();
    }
    else
    {
        echo "Erreur ! Votre compte ne peut être activé...";
    }
}

$query->CloseCursor();

?>