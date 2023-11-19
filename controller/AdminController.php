<?php

include_once('./config/db.php');
include_once('./model/UserModel.php');

class AdminController {
    private $conn;
    private $userModel;

    public function __construct() {
        $this->conn = $GLOBALS['conn'];
        $this->userModel = new UserModel();
    }

    public function showAdminPanel() {
        // Verificar si la sesión ya está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        // Obtener información del usuario actual
        $currentUser = $this->userModel->getUserById($_SESSION['user_id']);

        // Verificar si el usuario actual tiene permisos de administrador
        if ($currentUser['role'] !== 'admin') {
            // Redirigir a la página de acceso denegado o a la página de inicio
            header('Location: access_denied.php');
            exit();
        }

        // Obtener la lista de todos los usuarios
        $users = $this->userModel->getAllUsers();

        // Incluir la vista del panel de administrador
        include './view/admin.php';
    }
}
?>

