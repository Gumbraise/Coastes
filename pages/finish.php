<?php
$requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$userinfo = $requser->fetch();

if($userinfo['finish'] == 0) {
    if(!isset($_GET['key'])) {
?>
    <div class="finish">
        <p class="finish">
            <font class="finish1">
                Un Email vient d'être envoyé à l'adresse électronique
            </font>
            <br>
            <font class="finish2">
                <?php echo $userinfo['mail']; ?>
            </font>
        </p>
    </div>
    <?php
    } else {
        if($_GET['key'] == $userinfo['key_unique']) {
            $key = md5(time().sha1($userinfo['password']));
            $requser = $bdd->prepare("UPDATE users SET finish = 1 WHERE id = ?");
            $requser->execute(array($userinfo['id']));
            $requser = $bdd->prepare("UPDATE users SET key_unique = ? WHERE id = ?");
            $requser->execute(array($key, $userinfo['id']));
            $_SESSION['finish'] = 1;
    ?>
    <div class="finish">
        <p class="finish">
            <font class="finish1">
                Votre compte a bien été validé
            </font>
            <button href="?page=index" value="Cliquez ici">
        </p>
    </div>
    <?php
        } else {
    ?>
    <div class="finish">
        <p class="finish">
            <font class="finish1">
                Ce n'est pas la bonne key
            </font>
        </p>
    </div>
    <?php
        }
    }
} else {
    header("Location: ?page=index");
}
?>
