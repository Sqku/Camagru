<?php
function erreur($err='')
{
    $message=($err!='')? $err:'Une erreur inconnue s\'est produite';
    echo $message;
}
?>