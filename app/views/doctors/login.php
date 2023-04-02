<?php
    require_once('/var/www/html/WEB/TP2/app/helpers/url_helper.php');
    require_once('/var/www/html/WEB/TP2/app/models/doctor.php');
    require_once('/var/www/html/WEB/TP2/app/libraries/Database.php');
    require_once('/var/www/html/WEB/TP2/app/helpers/session_helper.php');

    $session = new session_helper();
    $url = new url_helper();
    $database = new Database();
    $doctor = new Doctor($database);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($doctor->login($email,$password)){
            $session->isLoggedIn();
            $url->redirect('/var/www/html/WEB/TP2/public/logout.php');
        } else {
            echo '<p style="color:purple; font-weight:bold; font-size: 24px; font-style: italic;">Invalid! Try again...</p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../../../public/css/login.css">
    </head>
    <body>
        <?php if($session->isLoggedIn()){ ?>
            <p style="color:mediumorchid; font-weight:bold; font-size: 24px;"> <?php echo $_SESSION['email']; ?>, You have been correctly authenticated</p>
            <a href="logout.php" style="font-size: 18px;"><i class="fa fa-sign-out"></i> Logout</a>
        <?php } else { ?>
            <form action="login.php" method="post">
                <label style="color:mediumorchid; font-size: 18px; font-weight:bold;">E-mail</label>
                <input type="text" name="email" placeholder="E-mail" style="font-size: 18px; color:indigo;"><br><br>
                <label style="color:mediumorchid; font-size: 18px; font-weight:bold;">Password</label>
                <input type="password" name="password" placeholder="Password" style="font-size: 18px; color:indigo;"><br><br>
                <p><input type="submit" id="submit" name="submit" value="Submit" style="background-color:mediumorchid; color:white; font-size: 18px; font-weight:bold; border:none; border-radius:5px; padding:10px;"></p>
            </form>
        <?php } ?>
    </body>
</html>










