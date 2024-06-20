<?php
//include_once '../../config/db.php';
//include_once '../models/Project.php';

//include_once __DIR__ . '/../../config/db.php';
//include_once __DIR__ . '/../models/Project.php';


include_once 'T:/xamp/htdocs/dashboard/SmartSheet/task_management_system/config/db.php';
include_once 'T:/xamp/htdocs/dashboard/SmartSheet/task_management_system/src/models/Project.php';

class ProjectController {
    public function show($projectId) {
        // Inicialize a conexão com o banco de dados
        $database = new Database();
        $db = $database->getConnection();

        // Obtenha o projeto
        $project = new Project($db);
        $project->id = $projectId;
        $projectData = $project->readOne();

        // Obtenha as tarefas do projeto
        $task = new Task($db);
        $task->project_id = $projectId;
        $tasks = $task->readByProject();

        // Inclua a view e passe os dados necessários
        $this->render('project', ['projectData' => $projectData, 'tasks' => $tasks]);
    }

    private function render($view, $data) {
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
    }
}
?>