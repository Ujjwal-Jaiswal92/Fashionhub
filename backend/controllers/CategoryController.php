<?php

require_once __DIR__ . '/../models/Category.php';

class CategoryController
{
    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    // Add Category
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $category_name = trim($_POST['category_name']);

        if (empty($category_name)) {
            die("Category name cannot be empty.");
        }

        if ($this->category->create($category_name)) {
            header("Location: ../../frontend/admin/categories.php?success=Category Added");
            exit();
        } else {
            die("Failed to add category.");
        }
    }

    // Get All Categories
    public function getAll()
    {
        return $this->category->getAll();
    }

    // Get Category By ID
    public function getById($id)
    {
        return $this->category->getById($id);
    }

    // Update Category
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $id = $_POST['category_id'];
        $category_name = trim($_POST['category_name']);

        if (empty($category_name)) {
            die("Category name cannot be empty.");
        }

        if ($this->category->update($id, $category_name)) {
            header("Location: ../../frontend/admin/categories.php?success=Category Updated");
            exit();
        } else {
            die("Failed to update category.");
        }
    }

    // Delete Category
    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        if ($this->category->delete($id)) {
            header("Location: ../../frontend/admin/categories.php?success=Category Deleted");
            exit();
        } else {
            die("Failed to delete category.");
        }
    }
}
?>