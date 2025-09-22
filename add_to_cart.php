<?php

include "dbcon.php";

session_start();


if (isset($_POST['item_id'])) {


    
    $item_id = $_POST['item_id'];
    $customer_id = $_POST['customer_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $totalPrice = $price * $quantity;

    $sql = "SELECT * FROM cart_items WHERE item_id = '$item_id' AND customer_id= '$customer_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $newQuantity = (int)$row["quantity"] + (int)$quantity;
        $newPrice = (float)$row["price"] + (float)$totalPrice;

        $sql = "UPDATE cart_items
        SET quantity = '$newQuantity', price = '$newPrice'
        WHERE item_id = '$item_id' AND customer_id= '$customer_id'";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $sql = "INSERT INTO cart_items (customer_id , item_id , quantity, price) VALUES ('$customer_id', '$item_id', $quantity, $totalPrice)";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
header("Location: menu.php");
