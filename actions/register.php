<?php
session_start();
if(isset($_POST['reg'])) {
    if(!empty($_POST['mail']) AND !empty($_POST['pass']) AND !empty($_POST['pass2']) AND !empty($_POST['pseudo']) AND !empty($_POST['check'])) {
        $pass = sha1($_POST['pass']);
        $pass2 = sha1($_POST['pass2']);
        if($pass == $pass2){
            $mail = $_POST['mail'];
            $pseudo = ucfirst(strtolower($_POST['pseudo']));
            $ip = $_SERVER['REMOTE_ADDR'];
            $key = md5(time().sha1($pass));
            $reqip = $bdd->prepare("SELECT * FROM users WHERE ip = ?");
            $reqip->execute(array($ip));
            $ipexist = $reqip->rowCount();
            if($ipexist == 0) {
                $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0) {
                    if(isset($_POST['phone'])) {
                        if(isset($_POST['pseudojoueur'])) {
                            $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, mail, password, ip, points, premium, perm, archive, finish, low, medium, hard, date, key_unique, phone, ami) VALUES(?, ?, ?, ?, 0, 0, 0, 0, 1, 0, 0, 0, UNIX_TIMESTAMP(), ?, ?, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $pass, $ip, $key, $_POST['phone'], $_POST['pseudojoueur']));
                        } else {
                            $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, mail, password, ip, points, premium, perm, archive, finish, low, medium, hard, date, key_unique, phone, ami) VALUES(?, ?, ?, ?, 0, 0, 0, 0, 1, 0, 0, 0, UNIX_TIMESTAMP(), ?, ?, 0)");
                            $insertmbr->execute(array($pseudo, $mail, $pass, $ip, $key, $_POST['phone']));
                        }
                    } else {
                        if(isset($_POST['pseudojoueur'])) {
                            $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, mail, password, ip, points, premium, perm, archive, finish, low, medium, hard, date, key_unique, phone, ami) VALUES(?, ?, ?, ?, 0, 0, 0, 0, 1, 0, 0, 0, UNIX_TIMESTAMP(), ?, 0, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $pass, $ip, $key, $_POST['pseudojoueur']));
                        } else {
                            $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, mail, password, ip, points, premium, perm, archive, finish, low, medium, hard, date, key_unique, phone, ami) VALUES(?, ?, ?, ?, 0, 0, 0, 0, 1, 0, 0, 0, UNIX_TIMESTAMP(), ?, 0, 0)");
                            $insertmbr->execute(array($pseudo, $mail, $pass, $ip, $key));
                        }
                    }
                    $requser = $bdd->prepare("SELECT * FROM users WHERE mail = ? AND password = ?");
                    $requser->execute(array($mail, $pass));
                    $userinfo = $requser->fetch();

                    $_SESSION['finish'] = 0;
                    $_SESSION['id'] = $userinfo['id'];
                    $_SESSION['mail'] = $userinfo['mail'];
                    $requser = $bdd->prepare("UPDATE users SET ip = ? WHERE id = ?");
                    $requser->execute(array($_SERVER['REMOTE_ADDR'], $userinfo['id']));

                    $reqfinish = $bdd->prepare("SELECT * FROM users WHERE id = ?");
                    $reqfinish->execute(array($_SESSION['id']));
                    $finish = $reqfinish->fetch();
                    
                    /*
                    $header="MIME-Version: 1.0\r\n";
                    $header.='From:"Coastes"<support@coast.es>'."\n";
                    $header.='Content-Type:text/html; charset="uft-8"'."\n";
                    $header.='Content-Transfer-Encoding: 8bit';
                    $message='
                    <html>
                       <body>
                          <div align="center">
                             <a href="http://127.0.0.1/?page=finish&key='.$key.'">Confirmez votre compte !</a>
                          </div>
                       </body>
                    </html>
                    ';
                    mail($mailo, "Confirmation de compte", $message, $header);
                    */

                    if($finish['finish'] == 0) {
                        header("Location: ?page=finish");
                    } else {
                        header("Location: ?page=index");
                    }
                } else {
                    header("Location: error.php?id=5");
                }
            } else {
                header("Location: error.php?id=4");
            }
        } else {
            header("Location: error.php?id=3");
        }
    } else {
        header("Location: error.php?id=2&register=1");
    }
} else {
    header("Location: error.php?id=1&register=1");
}
?>