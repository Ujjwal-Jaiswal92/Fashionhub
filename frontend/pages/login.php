<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login | FashionHub</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial;
}

body{
background:#f4f4f4;
}

.container{

width:350px;

margin:80px auto;

background:#fff;

padding:30px;

border-radius:10px;

box-shadow:0 0 10px rgba(0,0,0,.2);

}

input{

width:100%;

padding:10px;

margin-bottom:15px;

}

button{

width:100%;

padding:12px;

background:black;

color:white;

border:none;

cursor:pointer;

}

h2{

text-align:center;

margin-bottom:20px;

}

p{

text-align:center;

margin-top:15px;

}

</style>

</head>

<body>

<div class="container">

<h2>

Login

</h2>

<form

action="../../backend/api/auth.php?action=login"

method="POST"

>

<input

type="email"

name="email"

placeholder="Email"

required

>

<input

type="password"

name="password"

placeholder="Password"

required

>

<button>

Login

</button>

</form>

<p>

Don't have an account?

<a href="register.php">

Register

</a>

</p>

</div>

</body>

</html>