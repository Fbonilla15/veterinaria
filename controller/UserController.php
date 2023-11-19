<?php
class UserController {
    private $conn;
    private $userModel;

    public function __construct() {
        $this->conn = $GLOBALS['conn'];
        $this->userModel = new UserModel();
    }

    public function login() {
        // Lógica de inicio de sesión
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $user = $this->userModel->getUserByUsername($username);
    
            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sesión
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
    
                session_write_close(); // Cerrar la sesión antes de redireccionar
    
                // Redirigir a la página principal
                header('Location: index.php');
                exit();
            } else {
                echo "Credenciales incorrectas";
            }
        }
    
        // Vista de inicio de sesión
        include './view/login.php';
    }
    
    public function register() {
        // Lógica de registro
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Encriptar la contraseña
            $role = $_POST['role'];
    
            $result = $this->userModel->registerUser($username, $password, $role);
    
            if ($result) {
                session_start();
                session_write_close(); // Cerrar la sesión antes de redireccionar
    
                // Redirigir a la página de inicio de sesión
                header('Location: login.php');
                exit();
            } else {
                echo "Error al registrar el usuario";
            }
        }
    
        // Vista de registro
        include './view/register.php';
    }
}
?>
