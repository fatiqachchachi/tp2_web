<?php
require_once("/var/www/html/WEB/TP2/app/config/config.php");

class Database {
    private $db_name = DB_NAME;
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_password = DB_PASSWORD;
     private $connexion;
    private $statement;

    public function __construct(){
        $this->getConnection();
    }

    private function getConnection(){
        $this->connexion = null;
        try {
            $this->connexion = new PDO(
                'mysql:host=' . DB_HOST . ';dbname='. DB_NAME,
                DB_USER,
                DB_PASSWORD
            );
        } catch (PDOException $exception) {
            echo "Err : " . $exception->getMessage();
        }
    }

    public function prepare($sql) {
        $this->statement = $this->connexion->prepare($sql);
    }

    public function execute() {
        return $this->statement->execute();
    }

    public function single() {
        if ($this->execute()) {
            return $this->statement->fetch();
        } else {
            return false;
        }
    }

    public function resultSet() {
        if ($this->execute()) {
            return $this->statement->fetchAll();
        } else {
            return false;
        }
    }

    public function rowCount() {
        return $this->statement->rowCount();
    }
}

// $db = new Database();
//  $db->prepare("SELECT * FROM doctors");

// if ($db->execute()) {
//     echo "good";
// }
// else {
//     echo"notgood";
// }

// $db->prepare("SELECT * FROM doctors");
// $re=  $db->resultSet();
// echo $re["email"];


    // afficher le résultat
    // $result = $db->single();
    // if ($result) {
    //     print_r($result);
    // } else {
    //     echo "false";
    // }

    
//     $result = $db->resultSet();
//     if ($result) {
//         print_r($result);
//     } else {
//         echo "false";
//     }

    
//     $result = $db->rowCount();
//     if ($result) {
//         echo $result;
//     } else {
//         echo "false";
//     }
// } else {
//     echo "nop, try again...";
// }
?>
