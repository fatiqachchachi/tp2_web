 <?php
 require_once('/var/www/html/WEB/TP2/app/libraries/Database.php');

 class Doctor{
     private $id;
     private $name;
     private $email;
     private $password;
     private $speciality;
     private $db;
     
     public function __construct($db) {
         $this->db = $db;
     }
 
     public function fetchDoctorByEmail($email){
         $this->db->prepare("SELECT * FROM doctors WHERE email = '{$email}'");
         $this->db->execute();
 
         $doctor = $this->db->single();
 
         //retourne true or false
         if($doctor){
             $this->id = $doctor['id'];
             $this->name = $doctor['name'];
             $this->email = $doctor['email'];
             $this->password = $doctor['password'];
             $this->speciality = $doctor['speciality'];
             return true;
 
         }
         else
         return false;
     }
 
     public function login($email, $password){
         $this->db->prepare("SELECT * FROM doctors WHERE email = '{$email}'");
         $this->db->execute();
         $doctor = $this->db->single();
         
         if ($doctor) {
             $hashed_password = $doctor['password'];
             if (password_verify($password, $hashed_password)) {
                 $this->id = $doctor['id'];
                 $this->name = $doctor['name'];
                 $this->email = $doctor['email'];
                 $this->password = $doctor['password'];
                 $this->speciality = $doctor['speciality'];
                 return true;
             } else {
                 return false;
             }
         } else {
             return false;
         }
     }
 
     public function register($name, $email, $password, $speciality){
         $this->name = $name;
         $this->email = $email;
         $this->password = password_hash($password, PASSWORD_DEFAULT);
         $this->speciality = $speciality;
 
         $sql = "INSERT INTO doctors (name, email, password, speciality) VALUES ('$this->name', '$this->email', '$this->password', '$this->speciality')";
         $this->db->prepare($sql);
 
         if ($this->db->execute()){
             return true;
         } else {
             return false;
         }
     }
 
     public function getDoctorById($doctor_id) {
         $sql = "SELECT * FROM doctors WHERE id = '$doctor_id'";
         $this->db->prepare($sql);
         $this->db->execute();
         $doctor = $this->db->single();
     
         if ($doctor) {
             $this->id = $doctor['id'];
             $this->name = $doctor['name'];
             $this->email = $doctor['email'];
             $this->password = $doctor['password'];
             $this->speciality = $doctor['speciality'];
             return $this;
         } else {
             return false;
         }
     }
 }
 
 ?>
