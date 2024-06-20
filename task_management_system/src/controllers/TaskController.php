<?php
//include_once '../../config/db.php';
//include_once '../models/Task.php';

//include_once __DIR__ . '/../../config/db.php';
//include_once __DIR__ . '/../models/Task.php';

include_once 'T:/xamp/htdocs/dashboard/SmartSheet/task_management_system/config/db.php';
include_once 'T:/xamp/htdocs/dashboard/SmartSheet/task_management_system/src/models/Task.php';

class TaskController {
    private $db;
    private $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->task = new Task($this->db);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->task->project_id = $_POST['project_id'];
            $this->task->title = $_POST['title'];
            $this->task->description = $_POST['description'];
            $this->task->deadline = $_POST['deadline'];
            $this->task->status = $_POST['status'];
            $this->task->responsible = $_POST['responsible'];

            if ($this->task->create()) {
                header("Location: project.php?id=" . $this->task->project_id);
            } else {
                echo "Erro ao criar tarefa.";
            }
        }
    }

    public function read($project_id) {
        $this->task->project_id = $project_id;
        return $this->task->read();
    }
}
?>
