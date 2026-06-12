<?php
session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';
session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Top Star Hotel</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="styles/main.css" />
</head>
<body>

<!-- 🔹 BACKGROUND SLIDESHOW -->
<div class="bg-slideshow">
    <img src="images/background002.png" class="active" />
    <img src="images/background003.png" />
    <img src="images/background004.png" />
    <img src="images/background005.png" />
    <img src="images/background006.png" />
    <img src="images/background007.png" />
    <img src="images/background008.png" />
    <img src="images/background009.png" />
    <img src="images/background010.png" />
    <img src="images/background011.png" />
    <img src="images/background012.png" />
    <img src="images/background013.png" />
    <img src="images/background014.png" />
    <img src="images/background015.png" />
    <img src="images/background016.png" />
    <img src="images/background017.png" />
    <img src="images/services/background018.png" />
    <img src="images/services/background019.png" />
    <img src="images/services/background020.png" />
    <img src="images/services/background021.png" />
    <img src="images/services/background022.png" />
    <img src="images/services/background023.png" />
    <img src="images/services/background024.png" />
    <img src="images/services/background025.png" />
    <img src="images/services/background026.png" />
    <img src="images/services/background027.png" />
    <img src="images/services/background028.png" />
     <img src="images/services/background029.png" />
    <img src="images/services/background030.png" />
    <img src="images/services/background031.png" />
   

</div>
<?php
include "header.php";
?>


<!-- 🔹 HEADER -->
<div class="flex_header header_infor">
    <p class="welcome-subtext" id="typeText"></p>
</div>



<!-- 🔹 AUTH SECTION -->
<div class="auth-container">
    <div class="glass-card">

        <!-- TAB BUTTONS -->
        <div class="tab-buttons">
            <button id="loginTab"
                class="tab-btn <?= $activeForm === 'login' ? 'active' : '' ?>"
                onclick="showForm('login')">
                <i class="fas fa-right-to-bracket"></i>Login
            </button>

            <button id="registerTab"
                class="tab-btn <?= $activeForm === 'register' ? 'active' : '' ?>"
                onclick="showForm('register')">
                <i class="fas fa-user-plus"></i>Register
            </button>
        </div>

        <!-- LOGIN -->
        <div class="form-box" id="login-form"
             style="<?= $activeForm === 'login' ? 'display:block;' : 'display:none;' ?>">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login']); ?>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required />
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <button class="login" name="login">Login</button>
            </form>
        </div>

        <!-- REGISTER -->
        <div class="form-box" id="register-form"
             style="<?= $activeForm === 'register' ? 'display:block;' : 'display:none;' ?>">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register']); ?>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Full Name" required />
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required />
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button class="register" name="register">Register</button>
            </form>
        </div>

    </div>
</div>

<?php
include "footer.php";
?>

<!-- JS -->
<script src="styles/main.js"></script>
</body>
</html>
