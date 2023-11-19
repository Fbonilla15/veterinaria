<?php
include_once('./config/db.php');
include_once('./model/UserModel.php');
include_once('./model/MessageModel.php');


class ChatController {
    private $conn;
    private $userModel;
    private $messageModel;

    public function __construct() {
        $this->conn = $GLOBALS['conn'];
        $this->userModel = new UserModel();
        $this->messageModel = new MessageModel();
    }

    public function showChat() {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        if (isset($_GET['user_id'])) {
            $otherUserId = $_GET['user_id'];

            $currentUser = $this->userModel->getUserById($_SESSION['user_id']);
            $otherUser = $this->userModel->getUserById($otherUserId);

            // Puedes implementar tu lógica para verificar permisos aquí

            // Obtener mensajes del chat
            $messages = $this->messageModel->getMessages($_SESSION['user_id'], $otherUserId);

            // Incluir la vista del chat
            include '../view/chat.php';
        } else {
            // Obtener la lista de usuarios
            $users = $this->userModel->getUsers();

            // Incluir la vista de lista de usuarios
            include '../view/user_list.php';
        }
    }

    public function sendMessage() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newMessage = $_POST['message'];
            $receiverId = $_POST['receiver_id'];  // Obtener el ID del receptor desde el formulario

            // Insertar el nuevo mensaje en la base de datos
            $senderId = $_SESSION['user_id'];
            $result = $this->messageModel->insertMessage($senderId, $receiverId, $newMessage);

            if ($result) {
                // Mensaje insertado correctamente, puedes redirigir o realizar otras acciones según tus necesidades
                header("Location: index.php?user_id=$receiverId");
                exit();
            } else {
                echo "Error al enviar el mensaje";
            }
        }
    }
}
?>
