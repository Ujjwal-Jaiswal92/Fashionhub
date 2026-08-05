<?php

require_once __DIR__ . '/../config/database.php';

class Category
{
    private $conn;
    private $table = "categories";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Add Category
    public function create($category_name)
    {
        $query = "INSERT INTO {$this->table} (category_name)
                  VALUES (:category_name)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':category_name' => $category_name
        ]);
    }

    // Get All Categories
    public function getAll()
    {
        $query = "SELECT * FROM {$this->table}
                  ORDER BY category_id DESC";

        return $this->conn
                    ->query($query)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get Category By ID
    public function getById($id)
    {
        $query = "SELECT *
                  FROM {$this->table}
                  WHERE category_id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([
            ':id'=>$id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update Category
    public function update($id,$category_name)
    {
        $query = "UPDATE {$this->table}
                  SET category_name=:category_name
                  WHERE category_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':category_name'=>$category_name,
            ':id'=>$id
        ]);
    }

    // Delete Category
    public function delete($id)
    {
        $query = "DELETE FROM {$this->table}
                  WHERE category_id=:id";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }
}
?>