<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=mazerate', 'root', '');
if(isset($_SESSION['id'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: ?page=index");
}
else
{
    header("Location: ?page=index");
}
?>