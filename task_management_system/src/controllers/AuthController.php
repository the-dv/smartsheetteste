<?php
session_start();
//include_once __DIR__ . '/../../config/db.php';
//include_once __DIR__ . '/../models/User.php';
//include_once '../../config/db.php';
//include_once '../models/User.php';

include_once 'T:/xamp/htdocs/dashboard/SmartSheet/task_management_system/config/db.php';
include_once 'T:/xamp/htdocs/dashboard/SmartSheet/task_management_system/src/models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->name = $_POST['name'];
            $this->user->email = $_POST['email'];
            $this->user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if ($this->user->create()) {
                header("Location: login.php");
            } else {
                echo "Erro ao registrar.";
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->user->email = $_POST['email'];
            $stmt = $this->user->login();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($_POST['password'], $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                header("Location: projects.php");
            } else {
                echo "Email ou senha incorretos.";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
    }
}
?>
