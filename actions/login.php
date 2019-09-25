<?php
session_start();
if(isset($_POST['login'])){
      $mail = htmlspecialchars($_POST['mail']);
      $pass = sha1($_POST['password']);
      if(!empty($mail) AND !empty($pass)) {
            $requser = $bdd->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
            $requser->execute(array($mail, $pass));
            $userexist = $requser->rowCount();
            if($userexist == 1) {
                  $userinfo = $requser->fetch();
                  $_SESSION['id'] = $userinfo['id'];
                  $_SESSION['mail'] = $userinfo['mail'];
                  $requser = $bdd->prepare("UPDATE users SET ip = ? WHERE id = ?");
                  $requser->execute(array($_SERVER['REMOTE_ADDR'], $userinfo['id']));
                  header("Location: ?page=index");
            } else {
                  header("Location: ?page=index");
            }
      } else {
            header("Location: ?erreur=2&login=1");
      }
} else { 
      header("Location: ?erreur=1&login=1"); 
}
?>
