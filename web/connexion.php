<?php
    //session_start();
    include("db_start.php");
    include("debut.php");
    include("header.php");
    include("menu.php");
?>

<?php
if ($id!=0) erreur(ERR_IS_CO);
?>

<?php

if (!isset($_POST['pseudo']))
{
    echo '<form method="post" action="connexion.php">
	<fieldset>
	<legend>Connexion</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	</p>
	</fieldset>
	<p><input type="submit" value="Connexion" /></p></form>
	<a href="register.php">Pas encore inscrit ?</a>
	 
	</div>
	</body>
	</html>';
}

else
{
    $message='';
    $pseudo = $_POST['pseudo'];
    if (empty($_POST['pseudo']) || empty($_POST['password']) )
    {
        $message = '';
    }
    else
    {
        $query=$db->prepare('SELECT mdp, id, lvl, user_name, actif
        FROM users WHERE user_name = :pseudo');
        $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
        if ($data['mdp'] == sha1($_POST['password']))
        {
            if($query->execute(array(':pseudo' => $pseudo))  && $row = $query->fetch())
            {
                $actif = $row['actif'];
            }
            if($actif == 1)
            {
                $_SESSION['pseudo'] = $data['user_name'];
                $_SESSION['level'] = $data['lvl'];
                $_SESSION['id'] = $data['id'];
                $message = '<p>Bienvenue '.$data['user_name'].', 
                vous êtes maintenant connecté!</p>
                <p>Cliquez <a href="./deconnexion.php">ici</a> 
                pour vous deconnecter</p>';
            }
            else
            {
                echo 'Veuillez activer votre compte !';
            }
        }
        else
        {
            $message = '<p>Une erreur s\'est produite 
        pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a> 
        pour revenir à la page précédente
        <br /><br />Cliquez <a href="./index.php">ici</a> 
        pour revenir à la page d accueil</p>';
        }
        $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}

include("footer.php");
?>

<input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />

<?php
echo $_SERVER['HTTP_REFERER'];
$page = htmlspecialchars($_POST['page']);
echo 'Cliquez <a href="'.$page.'">ici</a> pour revenir à la page précédente';
?>


