<!-- 
            if ($this->db->execute()){
                return true;
            } else {
                // insertion not okay, on réaffiche
                $data['error'] = "Retry";
                return render('register.php', $data);
            }
        } else {
            // affichage formulaire
            return render('register.php', $data);
        }
        }
} -->

<?php
require_once("/var/www/html/WEB/TP2/app/models/doctor.php");
require_once("/var/www/html/WEB/TP2/app/libraries/Controller.php");
 class Doctors extends Controller{
    private $doctorModel;
    public function __construct(){
        $this ->doctorModel  = $this->loadModel("Doctor");
    }

    public function login(){
        $email=$_POST['email'] ;
        $password=$_POST['password'] ;

        if(!($this->Doctor->login($email,$password))){
            return false;
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            return true;
        }
        
    }
    public function register(){

        $data = [];

        if ($_SERVER['SUBMIT'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            //$this->passwd = password_hash($data['passwd'], PASSWORD_DEFAULT);
            $password = $_POST['password'];
            $speciality = $_POST['speciality'];

            if (empty($name)) {

                $data['name_error'] = "Please provide a name!";

            } 
            else {

                $data['name'] = $name;
            }

            if (empty($email)) {

                $data['email_error'] = "Please provide an email address!";

            } 
            else {
                $doctor = new Doctor();
                $dbDoctor = $doctor->fetchDoctorByEmail($email);
                if ($dbDoctor) {
                    $data['email_error'] = "This email address already exists!";
                } 
                else {
                    $data['email'] = $email;
                }
            }

            if (empty($password)) {

                $data['password_error'] = 'Please provide a password!';

            } elseif (strlen($password) < 8) {
                $data['password_error'] = "This password is too short! (8 characters minimum)";
            }

            if (empty($speciality)) {

                $data['speciality_error'] = "Please provide a speciality!";
            } else {
                $data['speciality'] = $speciality;
            }

            // Doc registration
            if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['speciality_error'])) {
                
                $doctor = new Doctor();

                $doctor->setName($name);
                $doctor->setEmail($email);
                $doctor->setPassword($password);
                $doctor->setSpeciality($speciality);

                if ($doctor->register()) {
                    redirect("/doctors/login");
                    exit;
                } else {
                    $data['error'] = 'Registration failed. Please try again later.';
                    $this->render('register', $data);
                }
            }

        }

        $this->render('register', $data);
    }



}



