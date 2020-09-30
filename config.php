<?php
// GLOBALS
const DEBUG = true; // Change on production
const AUTH = true; // Set sessions
const P_MODELS = 'models/';
const P_VIEWS = 'views/';
const P_UTILS = 'utils/';
const P_CONTROLLERS = 'controllers/';

// MOST USED REQUIRES
require_once P_UTILS . 'input_utils.php';
require_once P_MODELS . 'controller.php';
require_once P_UTILS . 'database.php';

// SETUP TEMPLATE ENGINE
require_once('vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader('views/');
if (DEBUG) {
    $twig = new \Twig\Environment($loader, [
        // 'cache' => 'cache',
    ]);
} else {
    $twig = new \Twig\Environment($loader, [
        'cache' => 'cache',
    ]);
}

// SESSIONS
if (AUTH) {

    require_once P_MODELS . 'user.php';

    session_start();

    if ( !isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        $_SESSION['user'] = new User();
    }
}



