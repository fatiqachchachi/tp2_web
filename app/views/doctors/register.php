<!-- <?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['register'])) {
        $usr->register();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../../../public/css/register.css">
    </head>
    <body>
        <form action="register.php" method="post">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name"><br><br>
            <label>Email</label>
            <input type="text" name="email" placeholder="Email"><br><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password"><br><br>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password"><br><br>
            <p><input type="submit" id="register" name="register" value="Register" /></p>
        </form>
    </body>
</html> -->






<!-- <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/var/www/html/WEB/TP2/app/helpers/session_helper.php';
require_once '/var/www/html/WEB/TP2/app/models/doctor.php';

$s = new session_helper();
$database = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
$doctor = new Doctor($database);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password == $confirm_password) {
            $doctor->setName($name);
            $doctor->setEmail($email);
            $doctor->setPassword(password_hash($password, PASSWORD_DEFAULT));

            if ($doctor->register()) {
                header('Location: login.php');
                exit;
            } else {
                echo 'Something went wrong';
            }
        } else {
            echo 'Passwords do not match';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="/var/www/html/WEB/TP2/public/css/register.css">
    </head>
    <body>
        <?php if (!$s->isLoggedIn()) : ?>
        <form action="register.php" method="post">
            <label>Name</label>
            <input type="text" name="name" placeholder="Name"><br><br>
            <label>Email</label>
            <input type="text" name="email" placeholder="Email"><br><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="Password"><br><br>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm Password"><br><br>
            <p><input type="submit" id="register" name="register" value="Register" /></p>
        </form>
        <?php else : ?>
        <p>You are already logged in.</p>
        <?php endif; ?>
    </body>
</html> -->



























<?php

require_once('/var/www/html/WEB/TP2/app/models/doctor.php');
require_once('/var/www/html/WEB/TP2/app/libraries/Database.php');

// Initialize the database object
$db = new Database();

// Initialize the doctor object
$doctor = new Doctor($db);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $speciality = $_POST['speciality'];

    // Register the doctor
    if ($doctor->register($name, $email, $password, $speciality)) {

        // Redirect to the login page
        header('Location: login.php');
        exit();

    } else {
        $error = "An error occurred while registering. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Doctor</title>
    <link rel="stylesheet" type="text/css" href="../../../public/css/register.css">
    
</head>
<body>
    <h1>Register</h1>

    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form method="post" action="">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Speciality:</label>
        <input type="text" name="speciality" required><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
