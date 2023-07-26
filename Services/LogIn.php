<?php
require("DBConnection.php");
require("Classes/LogInClass.php");

if($_SERVER['REQUEST_METHOD']=="GET"){
        if($is_connect){
            $login=new LogInClass();
            $login->pwd="ahmed";
            $login->uname="AHMED";
            $login->email="ahmed@gmail.com";
            if($login->checkInput()){
                $login->AddLogin();
            }else
            echo "Data Checked Error";

      
    




    }else
    echo "Connection Error";

}



?>