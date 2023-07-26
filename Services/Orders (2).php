<?php
require('DBConnection.php');
require("Classes/ordersClass.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order = new ordersClass();
    $isSaved = false;
    if (!empty($_POST['Controller'])) {
        if ($_POST['Controller'] == "delete" || $_POST['Controller'] == "update")
            $order->order_id = $_POST['order_id'];

        if ($_POST['Controller'] == "add" || $_POST['Controller'] == "update") {

            // echo "ACCESS";
            $order->order_authority_Id = $_POST['order_authority_Id'];
            $order->order_Customer_Id = $_POST['order_Customer_Id'];
            $order->order_Product_Id = $_POST['order_Product_Id'];

            $order->order_type = $_POST['order_type'];
            $order->order_description = $_POST['order_description'];
            $order->Quantity = $_POST['Quantity'];
            $order->Descount = $_POST['Descount'];
            $order->COST = $_POST['COST'];
            $order->PAID = $_POST['PAID'];
            $order->REST = $_POST['REST'];
            $order->OrderStatus = $_POST['status'];


            if (!empty($_POST['Active']))
                $order->order_active = 1;
            else
                $order->order_active = 0;

            $order->Notes = $_POST['Notes'];
            $order->Received_DATE = $_POST['Received_DATE'];


            if ($order->checkItem('add') || $order->checkItem('update')) {
                if ($_POST['Controller'] == "add") {
                    $isSaved = $order->addOrder();
                } else
                    $isSaved = $order->updateOrder();
            } else if ($_POST['Controller'] == "delete") {
                if ($order->checkItem('delete'))
                    $isSaved = $order->deleteOrder();
            }

            if ($isSaved)
                $msg = "Done";
            else
                $msg = "Error";

            echo json_encode(array("Operation" => $msg));
        }else if($_POST['Controller'] == "SaveCartsOrders"){
                if(!empty($_POST['CartsOrders'])){
                    $CartsOrder=json_decode($_POST['CartsOrders'],true);
                    $i=0;
                    while($i<count($CartsOrder)){
                        $order->order_authority_Id = $CartsOrder[$i]['order_authority_Id'];
                        $order->order_Customer_Id = $CartsOrder[$i]['order_Customer_Id'];
                        $order->order_Product_Id = $CartsOrder[$i]['order_Product_Id'];
            
                        $order->order_type = $CartsOrder[$i]['order_type'];
                        $order->order_description = $CartsOrder[$i]['order_description'];
                        $order->Quantity = $CartsOrder[$i]['Quantity'];
                        $order->Descount = $CartsOrder[$i]['Descount'];
                        $order->COST = $CartsOrder[$i]['COST'];
                        $order->PAID = $CartsOrder[$i]['PAID'];
                        $order->REST = $CartsOrder[$i]['REST'];
                        $order->OrderStatus = $CartsOrder[$i]['status'];
                        $order->active = $CartsOrder[$i]['Active'];
                        $order->Notes = $CartsOrder[$i]['Notes'];
                        if($order->checkItem('add')){
                            $order->addOrder();
                        }
                        $i=$i+1;
                    }
                    $msg="Done";
                }else
                $msg="Error";
                echo json_encode(array("Operation" => $msg));
        } else if ($_POST['Controller'] == "SearchAll") {
            $order->SearchAll();
            echo json_encode(array("Operation" => "Done", "Orders" => $order->Orders));
        }
    }
} else {
?>

    <form action="" method="POST">
        <input type="hidden" name="Controller" value="SearchAll" />
        <input type="number" name="order_authority_id" id="" placeholder="order_authority_id">
        <input type="text" name="order_Customer_Id" id="" placeholder="order_Customer_Id">
        <input type="text" name="order_Product_Id" id="" placeholder="order_Product_Id">
        <input type="text" name="order_type" id="" placeholder="order_type">
        <input type="text" name="order_description" id="" placeholder="order_description">
        <input type="text" name="Quantity" id="" placeholder="Quantity">
        <input type="text" name="Descount" id="" placeholder="Descount">
        <input type="text" name="PAID" id="" placeholder="PAID">
        <input type="text" name="REST" id="" placeholder="REST">
        <input type="text" name="status" id="" placeholder="status">
        <input type="text" name="Active" id="" placeholder="Active">
        <input type="text" name="Notes" id="" placeholder="Notes">
        <input type="text" name="Received_DATE" id="" placeholder="Received_DATE">
        for update Or delete controller inter her the id of collomn
        <input type="text" name="order_id" id="" placeholder="order_id">
        <input type="submit" value="Save">
    </form>


<?php
}
