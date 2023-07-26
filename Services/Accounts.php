<?php
require('DBConnection.php');
require("Classes/accountsClass.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account = new accountsClass();
    $isSaved = false;
    $procc_msg = "";
    if (!empty($_POST['Controller'])) {

        if ($_POST['Controller'] == "add" || $_POST['Controller'] == "update") {
            $account->fName = $_POST['fName'];
            $account->mName = $_POST['mName'];
            $account->lName = $_POST['lName'];
            $account->gender = $_POST['gender'];
            $account->bloodGroup = $_POST['bloodGroup'];
            $account->email = $_POST['email'];
            $account->birthDate = $_POST['birthDate'];
            $account->phoneNumber = $_POST['phoneNumber'];
            $account->password = $_POST['password'];

//            if ($_POST['Controller'] == "LogIn"){
//
//                $account->phoneNumber = $_POST['phoneNumber'];
//                $account->password = $_POST['password'];
//
//
//            }

        }

        if ($_POST['Controller'] == "add") {
            if ($account->checkItem("add")) {
                if ($account->addAccount()) {
                    $procc_msg = "Account Add successfully";

                } else {
                    $procc_msg = "Account Add error";
                }

            } else if ($_POST['Controller'] == "update") {

                if ($account->updateAccount()) {
                    $procc_msg = "Account update successfully";

                } else
                    $procc_msg = "Account update error.";
            }
            $array = array("Operation" => $procc_msg);
        } else if ($_POST['Controller'] == "delete") {
            if ($account->checkItem("delete")) {
                if ($account->deleteAccount()) {
                    $procc_msg = "Account deleted succesfully";
                } else {
                    $procc_msg = "account deleted error.";
                }
            } else {
                $procc_msg = "account check error.";
            }
            $array = array("Operation" => $procc_msg);
        } else if ($_POST['Controller'] == "SearchAll") {
            if ($account->SearchAll()) {
                $array = array("Operation" => "Done", "Accounts" => $account->Accounts);
            } else
                $array = array("Operation" => "Error");
        } else if ($_POST['Controller'] == "LogIn") {
            $account->phoneNumber = $_POST['phoneNumber'];
            $account->password = $_POST['password'];
            if (!empty($account->phoneNumber) && !empty($account->password)) {
                if ($account->LogIn()) {
                    $array = array("Operation" => "Done", "Accounts" => $account->Accounts);
                } else
                    $array = array("Operation" => "Error");
            } else
                $array = array("Operation" => "Error");

        }
    }
    echo json_encode($array);

} else {
    ?>
    <form action="" method="POST">

        <input type="hidden" name="Controller" value="LogIn"/>
        <input type="text" name="id" id="" placeholder="id"/><br/>
        <input type="text" name="fName" id="" placeholder="fName"/><br/>
        <input type="text" name="mName" id="" placeholder="mName"/><br/>
        <input type="text" name="lName" id="" placeholder="lName"/><br/>
        <input type="text" name="gender" id="" placeholder="gender"/><br/>
        <input type="text" name="bloodGroup" id="" placeholder="bloodGroup"/><br/>
        <input type="email" name="email" id="" placeholder="email"/><br/>
        <input type="date" name="birthDate" id="" placeholder="birthDate"><br/>
        <input type="PhoneNumber" name="phoneNumber" id="" placeholder="phoneNumber"><br/>
        <input type="password" name="password" id="" placeholder="password"/><br/>

        <input type="submit" value="Save">
    </form>


    <?php
}
