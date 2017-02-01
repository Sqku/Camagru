<?php

include("db_start.php");

?>
    <!DOCTYPE html>
    <meta charset="utf-8" />
    <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css"/>
<?php

include("header.php");


$login = $_GET['log'];
$cle = $_GET['cle'];

$query = $db->prepare("SELECT * FROM users WHERE user_name = ? AND cle = ?");
$query->execute(array($login, $cle));
$data = $query->fetch();

if($data)
{
    if (!isset($_POST['password']))
    {
        ?>
        <form method="post" action="set_pass.php?log=<?=$login?>&cle=<?=$cle?>">
	    <fieldset>
	    <legend>mot de passe oublie</legend>
	    <p>
	    <label for="password"> Nouveau mot de Passe :</label><input type="password" name="password" id="password" /><br />
	    
	    <label for="confirm"> Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" />
	    </p>
	    </fieldset>
	    <p><input type="submit" value="Reinitialiser le mot de passe" /></p></form>
        <?php
    }
    else
    {
        $pass = sha1($_POST['password']);
        $confirm = sha1($_POST['confirm']);

        if ($pass !== $confirm || empty($confirm) || empty($pass)) {
            $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent, ou sont vides";
            echo $mdp_erreur;
            echo '<p>Cliquez <a href="set_pass.php?log='.$login.'&cle='.$cle.'">ici</a> pour recommencer</p>';
        }
        else {
            $cle = '';
            $query = $db->prepare("UPDATE users SET mdp=:mdp, cle=:cleVide WHERE user_name=:user_name");
            $query->bindParam(':mdp', $pass);
            $query->bindParam(':cleVide', $cle);
            $query->bindParam(':user_name', $login);
            $query->execute();

            $new_mdp = "Votre mot de passe a bien ete reinitialise";
            echo $new_mdp;
            echo '<p>Cliquez <a href="./connexion.php">ici</a> pour vous connecter</p>';
        }
    }
}

else
{
    $erreur = "Ce lien n'est plus actif";
    echo $erreur;
    echo '<p>Cliquez <a href="./new_pass.php">ici</a> pour recommencer une procedure de reinitialisation de mot de passe</p>';
}

$query->CloseCursor();

include("footer.php");
include("fin.php");
?>