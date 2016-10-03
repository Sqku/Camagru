<?php
session_start();
session_unset();
session_destroy();
include("db_start.php");
include("debut.php");
include("header.php");
include("menu.php");
include("footer.php");

if ($id==0) erreur(ERR_IS_CO);

echo '<p>Vous êtes à présent déconnecté <br />
Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> 
pour revenir à la page précédente.<br />
Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p>';
echo '</div></body></html>';
?>