<?php // Include the config file
include 'include/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"]=="POST") {

    // Check if both email and password are provided
    if ( !empty($_POST['Email']) && !empty($_POST['password'])) {
        // Get user input
        $enteredEmail =$_POST['Email'];
        $enteredPassword =$_POST['password'];

        // Check if the entered email and password match the decoded ones
        if ($enteredEmail ==$email && $enteredPassword ==$password) {
            // Successful login, set the session variable and redirect to dashboard.php
            session_start();
            $_SESSION['loggedIn']=true;
            header("Location: dashboard.php");
            exit();
        }

        else {
            $error ="Invalid email or password";
        }
    }

    else {
        $error ="Both email and password are required";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #ecf0f3;
        font-family: 'Montserrat', sans-serif;
        transition: background-color 0.3s ease;
    }

    .main {
        position: relative;
        width: 350px;
        padding: 25px;
        background-color: #ecf0f3;
        box-shadow: 10px 10px 20px #d1d9e6, -10px -10px 20px #ffffff;
        border-radius: 12px;
        text-align: center;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* New Icon Circle Style */
    .icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #ecf0f3;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto 20px;
        box-shadow: 5px 5px 10px #d1d9e6, -5px -5px 10px #ffffff;
    }

    .icon-circle i {
        font-size: 36px;
        color: #4B70E2;
    }

    h2 {
        font-size: 24px;
        font-weight: 700;
        color: #181818;
        margin-bottom: 20px;
        transition: color 0.3s ease;
    }

    .form__input {
        width: 85%;
        height: 45px;
        margin: 15px 0;
        padding-left: 50px;
        font-size: 14px;
        border: none;
        outline: none;
        background-color: #ecf0f3;
        border-radius: 12px;
        box-shadow: inset 5px 5px 10px #d1d9e6, inset -5px -5px 10px #ffffff;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form__input:focus {
        box-shadow: inset 4px 4px 8px #d1d9e6, inset -4px -4px 8px #ffffff;
    }

    .button {
        width: 100%;
        height: 45px;
        margin-top: 20px;
        border-radius: 25px;
        background-color: #ecf0f3;
        color: #000000;
        font-weight: 700;
        box-shadow: 5px 5px 10px #d1d9e6, -5px -5px 10px #ffffff;
        border: none;
        outline: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .button:active {
        box-shadow: inset 5px 5px 10px #d1d9e6, inset -5px -5px 10px #ffffff;
        transform: scale(0.98);
    }

    .button:hover {
        background-color: #4B70E2;
        color: #fff;
        box-shadow: 5px 5px 15px #d1d9e6, -5px -5px 15px #ffffff;
        transform: scale(1.01);
    }

    .form__icon {
        font-size: 16px;
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0a5a8;
        transition: color 0.3s ease;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #a0a5a8;
        transition: color 0.3s ease;
    }

    .link {
        color: #4B70E2;
        margin-top: 10px;
        display: block;
        transition: color 0.3s ease;
    }

    /* Dark Mode Styles */
    body.dark-mode {
        background-color: #181818;
    }

    .dark-mode .main {
        background-color: #333;
        box-shadow: 10px 10px 20px #111, -10px -10px 20px #444;
    }

    .dark-mode h2 {
        color: #f1f1f1;
    }

    .dark-mode .form__input {
        background-color: #333;
        box-shadow: inset 5px 5px 10px #222, inset -5px -5px 10px #444;
        color: #f1f1f1;
    }

    .dark-mode .form__input::placeholder {
        color: #888;
    }

    .dark-mode .form__icon,
    .dark-mode .toggle-password {
        color: #888;
    }

    .dark-mode .button {
        background-color: #333;
        color: #fff;
        box-shadow: 5px 5px 10px #111, -5px -5px 10px #444;
    }

    /* Dark Mode Toggle Icon */
    .dark-mode-toggle {
        position: fixed;
        bottom: 15px;
        right: 15px;
        cursor: pointer;
        font-size: 24px;
        color: #888;
        transition: color 0.3s ease;
    }

    .dark-mode .dark-mode-toggle {
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="main">
        <!-- Key icon inside a circular container -->
        <div class="icon-circle">
            <i class="fas fa-key"></i>
        </div>
        <h2>Please Enter Your Login Details</h2> <!-- Login text below the icon -->

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div style="position: relative;">
                <i class="fas fa-envelope form__icon"></i>
                <input class="form__input" type="email" name="Email" placeholder="Email" required>
            </div>
            <div style="position: relative;">
                <i class="fas fa-lock form__icon"></i>
                <input class="form__input" type="password" name="password" id="password" placeholder="Password"
                    required>
                <i class="fas fa-eye toggle-password" id="togglePasswordIcon" onclick="togglePassword()"></i>
            </div>
            <button type="submit" class="button">LOGIN</button>

        </form>
        <?php if (isset($error)) { echo "<div style='color: red;'>$error</div>"; } ?>
    </div>

    <!-- Dark Mode Toggle Button -->
    <i class="fas fa-moon dark-mode-toggle" id="darkModeToggle" onclick="toggleDarkMode()"></i>

    <script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePasswordIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Toggle Dark Mode
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
    </script>
</body>

</html>