<?php

require_once "../../backend/middleware/admin.php";
require_once "../../backend/controllers/CategoryController.php";

$controller = new CategoryController();

$id = (int)($_GET['id'] ?? 0);
$category = $id ? $controller->getById($id) : null;
$isEditing = (bool)$category;

?>

<!DOCTYPE html>

<html>

<head>

<title><?= $isEditing ? 'Edit' : 'Add' ?> Category</title>

<style>

body{
font-family:Arial;
margin:40px;
}

input{
padding:10px;
width:300px;
}

button{
padding:10px 20px;
}

</style>

</head>

<body>

<h2><?= $isEditing ? 'Edit' : 'Add' ?> Category</h2>

<form
action="../../backend/api/categories.php?action=<?= $isEditing ? 'update' : 'create' ?>"
method="POST"
>

<?php if ($isEditing): ?><input
type="hidden"
name="category_id"
value="<?= $category['category_id']; ?>"
><?php endif; ?>

<input
type="text"
name="category_name"
value="<?= htmlspecialchars($category['category_name'] ?? ''); ?>"
required
>

<br><br>

<button>

<?= $isEditing ? 'Update' : 'Add' ?> Category

</button>

</form>

</body>

</html>
