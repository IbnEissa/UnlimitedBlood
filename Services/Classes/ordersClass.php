<?php
class ordersClass
{
    public $order_id, $order_authority_Id, $order_Customer_Id, $order_Product_Id, $order_type, $order_description, $Quantity, $Descount, $COST, $PAID, $REST, $OrderStatus, $Active, $Notes, $Received_DATE, $order_Date, $order, $Orders;

    public function checkItem($type)
    {

        if ($type != "add") {
            if (empty($this->order_id))
                return false;
        }
        if ($type != "delete") {
            if (empty($this->order_type))
                return false;
        }
        return true;
    }

    public function setData($query, $type)
    {

        if ($type != "delete") {
            $query->bindParam(":order_authority_Id", $this->order_authority_Id);
            $query->bindParam(":order_Customer_Id", $this->order_Customer_Id);
            $query->bindParam(":order_Product_Id", $this->order_Product_Id);
            $query->bindParam(":order_type", $this->order_type);
            $query->bindParam(":order_description", $this->order_description);
            $query->bindParam(":Quantity", $this->Quantity);
            $query->bindParam(":Descount", $this->Descount);
            $query->bindParam(":cost", $this->COST);
            $query->bindParam(":PAID", $this->PAID);
            $query->bindParam(":REST", $this->REST);
            $query->bindParam(":OrderStatus", $this->OrderStatus);
            $query->bindParam(":Active", $this->Active);
            $query->bindParam(":Notes", $this->Notes);
            $query->bindParam(":Received_DATE", $this->Received_DATE);
            // $query->bindParam(":order_Date",$this->order_Date);


        }
        if ($type != "add") {
            $query->bindParam(":order_id", $this->order_id);
        }
        if ($query->execute())
            return true;


        return false;
    }


    public function addOrder()
    {
        global $connection;


        return $this->setData($connection->prepare("INSERT INTO `orders` VALUES(NULL,:order_authority_Id ,:order_Customer_Id,:order_Product_Id,:order_type,:order_description,:Quantity,:Descount,:cost,:PAID,:REST,:OrderStatus,:Active,:Notes,:Received_DATE,now()); "), "add");
    }

    public function updateOrder()
    {
        global $connection;
        return $this->setData($connection->prepare("UPDATE `orders` SET `order_authority_Id`=:order_authority_Id,`order_Customer_Id`=:order_Customer_Id,`order_Product_Id`=:order_Product_Id,`order_type`=:order_type,`order_description`=:order_description,`Quantity`=:Quantity,`Descount`=:Descount,`cost`=:cost,`PAID`=:PAID,`REST`=:REST,`status`=:OrderStatus,`Active`=:Active,`Notes`=:Notes,`Received_DATE`=:Received_DATE WHERE `order_id`=:order_id  "), "update");
    }
    public function payOrder()
    {
        global $connection;
        $query=$connection->prepare("UPDATE `orders` SET `status`='Waiting' WHERE `order_id`=$this->order_id  ");
        $query->execute();
        // $query->bindParam("order_id",$this->order_id);
    }
    public function deleteOrder()
    {
        global $connection;
        return $this->setData($connection->prepare("DELETE FROM `orders` WHERE `order_id`=:order_id  "), "delete");
    }

    public function SearchAll()
    {
        global $connection;
        $query = $connection->prepare("SELECT * FROM `orders`");
        $this->Orders = array();
        if ($query->execute()) {
            while ($row = $query->fetchObject()) {
                $this->Orders[] = $row;
            }
        }
    }
}
