<?php
session_start();
$conn = new mysqli('localhost','root','','top_star_hotel');
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
    $stmt->bind_param("sss",$name,$email,$password);
    $stmt->execute();

    header("Location: login.php");
    exit();
}
?>

<h1>Register</h1>
<form method="POST">
Name: <input type="text" name="name" required><br>
Email: <input type="email" name="email" required><br>
Password: <input type="password" name="password" required><br>
<input type="submit" name="register" value="Register">
</form>
