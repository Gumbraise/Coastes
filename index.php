<?php
include('pages/start.php');
if(isset($_GET['page'])) {
    switch($_GET['page']) {
        case 'index':
            if(isset($_SESSION['id'])) {
                include('pages/accueil.php');
            } else {
                include('pages/index.php');
            }
            break;
        case 'profile':
            if(isset($_SESSION['id'])) {
                include('pages/profile.php');
            } else {
                include('pages/login.php');
            }
            break;
        case 'login':
            if(isset($_SESSION['id'])) {
                include('pages/accueil.php');
            } else {
                include('pages/login.php');
            }
            break;
        case 'register':
            if(isset($_SESSION['id'])) {
                include('pages/accueil.php');
            } else {
                include('pages/register.php');
            }
            break;
        case 'accueil':
            if(isset($_SESSION['id'])) {
                include('pages/accueil.php');
            } else {
                include('pages/index.php');
            }
        default:
            if(isset($_SESSION['id'])) {
                include('pages/accueil.php');
            } else {
                include('pages/index.php');
            }
            break;
    }
}
else if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'login':
            include('actions/login.php');
            break;
        case 'register':
            include('actions/register.php');
            break;
        case 'disconnect':
            include('actions/deconnexion.php');
            break;
        case 'coast':
            include('actions/coast.php');
            break;
        default:
            include('erreur/404.php');
            break;
    }
}
else if(isset($_GET['erreur'])) {
    switch($_GET['erreur']) {
        case '1':
            if(isset($_GET['login'])) {
                include('erreurs/1l.php');
            } else if(isset($_GET['register'])) {
                include('erreurs/1r.php');
            } else {
                include('erreurs/401.php');
            }
            break;
        case '2':
            if(isset($_GET['login'])) {
                include('erreurs/2l.php');
            } else if(isset($_GET['register'])) {
                include('erreurs/2r.php');
            } else {
                include('erreurs/401.php');
            }
            break;
        case '3':
            include('erreurs/3.php');
            break;
        case '4':
            include('erreurs/4.php');
            break;
        case '5':
            include('erreurs/5.php');
            break;
        case '400':
            include('erreurs/400.php');
            break;
        case '401':
            include('erreurs/401.php');
            break;
        case '403':
            include('erreurs/403.php');
            break;
        case '404':
            include('erreurs/404.php');
            break;
        default:
            include('erreurs/404.php');
            break;
    }
} else {
    if(isset($_SESSION['id'])) {
        if($_SESSION['finish'] == 1) {
            include('pages/index.php');
        } else {
            include('pages/finish.php');
        }
    } else {
        include('pages/index.php');
    }
}
include('pages/end.php');
?>