<?php
class Task {
    private $conn;
    private $table_name = "tasks";

    public $id;
    public $project_id;
    public $title;
    public $description;
    public $deadline;
    public $status;
    public $responsible;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET project_id=:project_id, title=:title, description=:description, deadline=:deadline, status=:status, responsible=:responsible";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $this->project_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":deadline", $this->deadline);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":responsible", $this->responsible);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE project_id = :project_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $this->project_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
