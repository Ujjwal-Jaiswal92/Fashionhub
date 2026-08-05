<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FashionHub</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f4f4;
        }

        .container{
            width:400px;
            margin:50px auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            background:#000;
            color:#fff;
            cursor:pointer;
        }

        button:hover{
            background:#333;
        }

        p{
            text-align:center;
            margin-top:15px;
        }

        a{
            text-decoration:none;
        }

    </style>

</head>

<body>

<div class="container">

<h2>Create Account</h2>

<form
action="../../backend/api/auth.php?action=register"
method="POST"
>

<input
type="text"
name="full_name"
placeholder="Full Name"
required
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

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required
>

<input
type="text"
name="phone"
placeholder="Phone Number"
>

<textarea
name="address"
placeholder="Address"
></textarea>

<select name="role" required>

<option value="">Select Role</option>

<option value="customer">
Customer
</option>

<option value="seller">
Seller
</option>

</select>

<button type="submit">

Register

</button>

</form>

<p>

Already have an account?

<a href="login.php">

Login

</a>

</p>

</div>

</body>
</html>