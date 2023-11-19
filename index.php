<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include_once('controller/ChatController.php');
include_once('controller/AdminController.php');
include_once('controller/UserController.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'login':
        $userController = new UserController();
        $userController->login();
        break;

    case 'register':
        $userController = new UserController();
        $userController->register();
        break;

    case 'chat':
        $chatController = new ChatController();
        $chatController->showChat();
        break;

    case 'admin':
        $adminController = new AdminController();
        $adminController->showAdminPanel();
        break;

    default:
        include 'view/home.php';
        break;
}
?>
