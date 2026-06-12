<?php
session_start();
require_once 'connect.php';

// -------- REGISTER --------
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = trim($_POST['role']); // 'admin' or 'user'

    // Validation: no spaces in email or password
    if (preg_match('/\s/', $email)) {
        $_SESSION['register_error'] = 'Email should not contain spaces.';
        $_SESSION['active_form'] = 'register';
        header("location: index.php");
        exit();
    }
    if (preg_match('/\s/', $password)) {
        $_SESSION['register_error'] = 'Password should not contain spaces.';
        $_SESSION['active_form'] = 'register';
        header("location: index.php");
        exit();
    }

    // Validate role
    if ($role !== 'admin' && $role !== 'user') {
        $_SESSION['register_error'] = 'Invalid role selected.';
        $_SESSION['active_form'] = 'register';
        header("location: index.php");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
        header("location: index.php");
        exit();
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users(name, email, password, role) VALUES(?,?,?,?)");
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
    $stmt->execute();

    $_SESSION['register_success'] = 'Registration successful. You can now log in.';
    $_SESSION['active_form'] = 'login';
    header("location: index.php");
    exit();
}

// -------- LOGIN --------
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation: no spaces in email or password
    if (preg_match('/\s/', $email)) {
        $_SESSION['login_error'] = 'Email should not contain spaces.';
        $_SESSION['active_form'] = 'login';
        header("location: index.php");
        exit();
    }
    if (preg_match('/\s/', $password)) {
        $_SESSION['login_error'] = 'Password should not contain spaces.';
        $_SESSION['active_form'] = 'login';
        header("location: index.php");
        exit();
    }

    // Fetch user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Store session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; // crucial for admin_page.php access

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("location: admin_page.php");
            } else {
                header("location: user_page.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("location: index.php");
    exit();
}
?>
