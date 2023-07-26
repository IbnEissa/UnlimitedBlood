<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$is_connect = false;
$connection_err = "";
try {
    $connection = new PDO("mysql:host=localhost;
dbname=unlimitedblood;
port=3306;charset=utf8;
",
        "root", "");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if ($connection) {
        $connection_err = "";
        $is_connect = true;

    }

} catch (Exception $ex) {
    $is_connect = false;
    $connection_err = $ex->getMessage();
}

// echo password_hash("ahmed",PASSWORD_BCRYPT);

?>