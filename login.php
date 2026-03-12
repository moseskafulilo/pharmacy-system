<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$query=mysqli_query($conn,"SELECT * FROM users
WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($query)>0){

$row=mysqli_fetch_assoc($query);

$_SESSION['user']=$row['username'];
$_SESSION['role']=$row['role'];

header("Location:dashboard.php");

}else{

echo "Invalid Login";

}

}
?>
<link rel="stylesheet" href="style.css">

<h2>Login</h2>

<form method="POST">

<input type="text" name="username" placeholder="Username">

<br><br>

<input type="password" name="password" placeholder="Password">

<br><br>

<button name="login">Login</button>

</form>
