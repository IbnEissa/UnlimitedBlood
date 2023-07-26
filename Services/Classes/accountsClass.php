<?php
// this class will contain the functions that will : 
// ->  checkItems method -> the type of the process that will be processed and will get one parameter .
// ->  setData -> this function will do the check the process and the and then set the values to the variables using the function bindParam .
// ->  the function that determine the process and these functions will return the value of the function setData .
// ->  these functions are the add,update ,and the delete function .

class accountsClass
{

    public $id,
        $fName,
        $mName,
        $lName,
        $gender,
        $bloodGroup,
        $email,
        $birthDate,
        $phoneNumber,
        $password,
        $Accounts;

    public function checkItem($type)
    {
        if ($type != "add" || $type != "LogIn") {
            if (empty($this->id))
                return false;
        }
        if ($type != "delete") {

            if (empty($this->fName))
                return false;
            if (empty($this->lName))
                return false;
            if (empty($this->password))
                return false;
            if (empty($this->phoneNumber))
                return false;
            if (empty($this->email))
                return false;
            if (empty($this->bloodGroup))
                return false;
            if (empty($this->gender))
                return false;
        }


        return true;
    }


    public function setData($query, $type)
    {
        global $connection;
        if ($type != "delete") {
            if ($type == "add"){
                $query->bindParam(":fName", $this->fName);
                $query->bindParam(":mName", $this->mName);
                $query->bindParam(":lName", $this->lName);
                $query->bindParam(":gender", $this->gender);
                $query->bindParam(":bloodGroup", $this->bloodGroup);
                $query->bindParam(":email", $this->email);
                $query->bindParam(":birthDate", $this->birthDate);
                $query->bindParam(":phoneNumber", $this->phoneNumber);
                $query->bindParam(":password", $this->password);

            }
//                $this->password = password_hash($this->password, PASSWORD_BCRYPT_DEFAULT_COST);


            if ($type == "LogIn") {
                $query->bindParam(":phoneNumber", $this->phoneNumber);
                $query->bindParam(":password", $this->password);

                if ($query->execute()) {
                    echo "done";
                    if ($query->rowCount() > 0) {
                        print ("there is data ");
                        $this->Accounts = array();
                        if ($row = $query->fetchObject()) {
//                if (password_verify($this->password, $row->password)) {
//                    print ("the passwords are equals ");
                            $this->Accounts[] = $row;
                            return true;
                        }

                    }
                }

                if ($type != "add" || $type != "LogIn")
                    $query->bindParam(":id", $this->id);

                if ($query->execute()) {
                    echo "done";
                    if ($type == "add")
                        $this->id = $connection->lastInsertId();

                    return true;

                }
                return false;
            }

        }
    }

    public function addAccount()
    {
        global $connection;
        return $this->setData($connection->prepare("INSERT INTO `usersdetails` VALUES
                               (NULL,:fName,:mName,:lName,:gender,:bloodGroup,:email,:birthDate,:phoneNumber,:password);"), "add");
    }

    public function updateAccount()
    {
        global $connection;
        return $this->setData(
            $connection->prepare("UPDATE `usersdetails` SET
                          `fName`=:fName,
                          `mName`=:mName ,
                          `lName`=:lName,`gender`=:gender,
                          `bloodGroup`=:bloodGroup,`email`=:aemail,
                          `birthDate`=:birthDate,`phoneNumber`=:phoneNumber,
                          `password`=:password   WHERE `id`=:id  "),
            "update");
    }

    public function deleteAccount()
    {
        global $connection;
        return $this->setData(
            $connection->prepare(
                "DELETE FROM 
           `usersdetails`
       WHERE `id` =:id "),
            "delete");
    }

    public function SearchAll()
    {
        global $connection;
        $proces = false;
        $query = $connection->prepare("SELECT * FROM `usersdetails`");
        $this->Accounts = array();
        if ($query->execute()) {
            while ($row = $query->fetchObject()) {
                $this->Accounts[] = $row;
            }
            $proces = true;
        }
        return $proces;
    }

    public  function LogIn()
    {
        print ("the number is : " . $this->phoneNumber . "the password is : " . $this->password);
        global $connection;
        $proces = false;
        $result = $this->setData($connection->prepare("SELECT * FROM `usersdetails` WHERE `phoneNumber` =:phoneNumber AND `password` =:password"), "LogIn");
//        $query->bindParam(":phoneNumber", $this->phoneNumber,":password", $this->password);
//        $query->execute();
//        if ($query->rowCount() > 0) {
//            print ("there is data ");
//            $proces = true;
//        }
        if ($result) {

            $proces = true;

        } else
            $proces = false;


//        print ("the results is  " . $proces);
    return $proces;
}

}
