<?php

require_once "../../backend/middleware/admin.php";
require_once "../../backend/controllers/CategoryController.php";

$controller = new CategoryController();

$id = $_GET['id'];

$category = $controller->getById($id);

?>

<!DOCTYPE html>

<html>

<head>

<title>Edit Category</title>

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

<h2>Edit Category</h2>

<form
action="../../backend/api/categories.php?action=update"
method="POST"
>

<input
type="hidden"
name="category_id"
value="<?= $category['category_id']; ?>"
>

<input
type="text"
name="category_name"
value="<?= htmlspecialchars($category['category_name']); ?>"
required
>

<br><br>

<button>

Update Category

</button>

</form>

</body>

</html>