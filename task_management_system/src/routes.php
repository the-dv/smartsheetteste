<?php
require_once 'controllers/AuthController.php';
require_once 'controllers/ProjectController.php';
require_once 'controllers/TaskController.php';

$authController = new AuthController();
$projectController = new ProjectController();
$taskController = new TaskController();

// Rotas de Autenticação
if ($_SERVER['REQUEST_URI'] === '/register') {
    $authController->register();
    include_once 'views/register.php';
} elseif ($_SERVER['REQUEST_URI'] === '/login') {
    $authController->login();
    include_once 'views/login.php';
} elseif ($_SERVER['REQUEST_URI'] === '/logout') {
    $authController->logout();
}

// Rotas de Projetos
if ($_SERVER['REQUEST_URI'] === '/projects') {
    $projects = $projectController->read();
    include_once 'views/projects.php';
} elseif ($_SERVER['REQUEST_URI'] === '/project') {
    if (isset($_GET['id'])) {
        $project_id = $_GET['id'];
        $tasks = $taskController->read($project_id);
        include_once 'views/project.php';
    }
}

// Rotas de Tarefas
if ($_SERVER['REQUEST_URI'] === '/task/create') {
    $taskController->create();
    include_once 'views/task.php';
}
?>
