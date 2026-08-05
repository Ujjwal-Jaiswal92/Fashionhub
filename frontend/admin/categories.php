<?php

require_once "../../backend/middleware/admin.php";
require_once "../../backend/controllers/CategoryController.php";

$categoryController = new CategoryController();
$categories = $categoryController->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Categories</title>

<style>

body{
    font-family:Arial, Helvetica, sans-serif;
    margin:40px;
    background:#f5f5f5;
}

.container{
    width:900px;
    margin:auto;
}

h2{
    margin-bottom:20px;
}

form{
    margin-bottom:30px;
}

input{
    padding:10px;
    width:300px;
}

button{
    padding:10px 20px;
    cursor:pointer;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th,
table td{
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
}

table th{
    background:black;
    color:white;
}

a{
    text-decoration:none;
}

.edit{
    color:blue;
}

.delete{
    color:red;
}

.success{
    color:green;
    margin-bottom:20px;
}

</style>

</head>

<body>

<div class="container">

<h2>Category Management</h2>

<?php

if(isset($_GET['success']))
{
    echo "<p class='success'>".$_GET['success']."</p>";
}

?>

<form
action="../../backend/api/categories.php?action=create"
method="POST"
>

<input
type="text"
name="category_name"
placeholder="Category Name"
required
>

<button type="submit">

Add Category

</button>

</form>

<table>

<tr>

<th>ID</th>

<th>Category</th>

<th>Actions</th>

</tr>

<?php foreach($categories as $category): ?>

<tr>

<td>

<?= $category['category_id']; ?>

</td>

<td>

<?= htmlspecialchars($category['category_name']); ?>

</td>

<td>

<a
class="edit"
href="edit-category.php?id=<?= $category['category_id']; ?>"
>

Edit

</a>

|

<a
class="delete"
onclick="return confirm('Delete this category?')"
href="../../backend/api/categories.php?action=delete&id=<?= $category['category_id']; ?>"
>

Delete

</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</div>

</body>

</html>