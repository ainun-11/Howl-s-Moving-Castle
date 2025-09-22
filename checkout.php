<?php
session_start();
include "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_SESSION['user_id'];
    $sql = "SELECT ci.item_id, ci.quantity, mi.item_price
            FROM cart_items ci
            JOIN menu_items mi ON ci.item_id = mi.item_id
            WHERE ci.customer_id = '$customer_id';";
    $result = $conn->query($sql);

    $totalPrice = 0;
    while ($row = $result->fetch_assoc()) {
        $totalPrice += $row["quantity"] * $row["item_price"];
    }

    
    $insertOrderQuery = "INSERT INTO orders (customer_id, order_date, total_amount) VALUES ('$customer_id', NOW(), '$totalPrice')";
    $conn->query($insertOrderQuery);
    $order_id = $conn->insert_id;

    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        $item_id = $row["item_id"];
        $quantity = $row["quantity"];
        $insertOrderItemQuery = "INSERT INTO order_items (order_id, item_id, quantity) 
                                VALUES ('$order_id', '$item_id', '$quantity')";
        $conn->query($insertOrderItemQuery);
    }
    $deleteCartQuery = "DELETE FROM cart_items WHERE customer_id = '$customer_id'";
    $conn->query($deleteCartQuery);
    header("Location: order_history.php");
    exit();
}
