<?php
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = $GLOBALS['conn'];
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM users WHERE id = '$userId'";
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $this->conn->error);
        }

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $this->conn->error);
        }

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function getUsers() {
        $sql = "SELECT id, username FROM users";
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $this->conn->error);
        }

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    public function getAllUsers() {
        $sql = "SELECT id, username, role FROM users";
        $result = $this->conn->query($sql);

        if ($result === false) {
            die("Error al ejecutar la consulta: " . $this->conn->error);
        }

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    public function registerUser($username, $password, $role) {
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        return $this->conn->query($sql);
    }
}
?>
