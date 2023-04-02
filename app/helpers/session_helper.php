<?php

class session_helper{

    public function __construct(){

        session_start();
    }

function isLoggedIn(){
    
    if (isset($_SESSION['doctor_id'])){
        return true;
    }
    else{
        return false;
    }
}

}

