<?php
class MessageModel {
    private $conn;

    public function __construct() {
        $this->conn = $GLOBALS['conn'];
    }

    public function getMessages($senderId, $receiverId) {
        $sql = "SELECT * FROM messages WHERE (sender_id = '$senderId' AND receiver_id = '$receiverId') OR (sender_id = '$receiverId' AND receiver_id = '$senderId') ORDER BY timestamp ASC";
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $this->conn->error);
        }

        $messages = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }

        return $messages;
    }

    public function insertMessage($senderId, $receiverId, $content) {
        $sql = "INSERT INTO messages (sender_id, receiver_id, content, timestamp) VALUES ('$senderId', '$receiverId', '$content', NOW())";
        return $this->conn->query($sql);
    }
}
?>
