<?php

require_once 'backend/config.php';

$isLoggedIn = false;
require_once 'frontend/header.php';



if ($isLoggedIn) {
    require_once 'frontend/navbaruser.php';

    switch ($_GET['page']) {
        case 'logout':
            require_once 'frontend/logout.php';
            break;
        default:
            require_once 'frontend/index.html';
            break;
    }
} else {
    require_once 'frontend/navbarguest.php';

    switch ($_GET['page']) {
        case 'login':
            require_once 'frontend/login.php';
            break;
        case 'register':
            require_once 'frontend/register.php';
            break;
        default:
            require_once 'frontend/index.html';
            break;
    }
}
require_once 'frontend/footer.php';
