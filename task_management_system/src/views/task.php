<?php
class Task {
    private $conn;
    private $table_name = "tasks";

    public $id;
    public $project_id;
    public $title;
    public $description;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readByProject() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE project_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->project_id);
        $stmt->execute();
        return $stmt;
    }
}
?>
