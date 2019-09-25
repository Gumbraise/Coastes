<?php
$requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$userinfo = $requser->fetch();

switch($_POST['find']) {
    case 5:
        $low = ($userinfo['low'] + 1);
        $requsers = $bdd->prepare("UPDATE users SET low = ? WHERE id = ?");
        $requsers->execute(array($low, $_SESSION['id']));
        break;
    case 10:
        $medium = ($userinfo['medium'] + 1);
        $requser = $bdd->prepare("UPDATE users SET medium = ? WHERE id = ?");
        $requser->execute(array($medium, $_SESSION['id']));
        break;
    case 20:
        $hard = ($userinfo['hard'] + 1);
        $requser = $bdd->prepare("UPDATE users SET hard = ? WHERE id = ?");
        $requser->execute(array($hard, $_SESSION['id']));
        break;
}
?>