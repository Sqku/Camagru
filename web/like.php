<?php

include("db_start.php");

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

require 'Vote.class.php';

$vote = new Vote($db);

if($_POST['vote'] == 1)
{
    $vote->like($_POST['id'], $_SESSION['id']);
}
else if($_POST['vote'] == -1)
{
    $vote->dislike($_POST['id'], $_SESSION['id']);
}

header('location: apercu.php?id='.$_POST['id']);

?>