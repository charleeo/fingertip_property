<?php

class Database{
    public $dbconnector; //Database connection handler
    public function __construct(){
        $this->dbconnector = new mysqli("127.0.0.1", "root", "", "newproject");
        if($this->dbconnector->connect_error)
        {
           
            exit("Connection fails".$this->dbconnector->connect_error);
        }else{
           return true;
        }
    }
}
session_start();
if(isset($_SESSION['success_flash'])){
    echo '<div class = "bg-success" id="timer">'
    .$_SESSION['success_flash'].'</div>';
    unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
    echo '<div class = "bg-danger" id="timer">'
    .$_SESSION['error_flash'].'</div>';
    unset($_SESSION['error_flash']);
}
require_once("helper_functions.php");

