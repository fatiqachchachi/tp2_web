<?php

require_once('app/config/config.php');
require_once('app/helpers/session_helper.php');
require_once('app/helpers/url_helper.php');
require_once('app/models/doctor.php');
require_once('app/libraries/Database.php');
require_once('app/controllers/doctors.php');
require_once('app/libraries/Controller.php');
require_once('app/libraries/Core.php');


$session = new session_helper();
$url = new url_helper();
$doctor = new Doctors();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['register'])) {
        $url->redirect('app/views/doctors/register.php');
        exit;
    }
    if (!($doctor->login()))
    {
        echo '<p style="color:#FF0000; font-weight:bold;">Erreur de connexion.</p>';
        exit;
    }

    header("Location: index.php");

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type ="text/css" href="static/login.css">
    </head>
    <body>
        <?php if($s->isLoggedIn()){ ?>
        <p><?php echo $_SESSION['email']; ?>,correctly authetificated</p>
        <a href="logout.php">Logout</a>
        <?php } else { ?>
        <form action="index.php" method="post">
        <label>E-mail</label>
        <input type="text" name="email" placeholder="E-mail"><br><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br><br>
        <p><input type="submit" id="submit" name="submit" value="Submit" /></p>
        <p><input type="submit" id="register" name="register" value="Register" /></p>
        </form>
        <?php } ?>
    </body>
</html>
