<?php
session_start();


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    
    require_once "dbcon.php";

    $query = "SELECT admin_id FROM admins WHERE admin_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            header("Location: admin.php");
            exit();
        }
        
    } else {
        
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/orderhistory.css">
    <title>HMC | Order History</title>
</head>

<body>
    <div class="contaier">
        <img id="logo" src="assets/logo.png" alt="" />
        <header id="top">
            <section class="home">
                <div class="nav">
                    <div class="logo">
                        <h1>Howl's Moving Cafe</h1>
                    </div>
                    <div>
                        <ul>
                            <li><a href="landing.php">Home</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li><a href="cart.php">View Cart</a></li>
                            <li><a class="active" href="order_history.php">Order History</a></li>
                            <li><a href="about.php">About us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>

        <main>
            <section class="order-history">
                <?php
                include "dbcon.php";

                $customer_id = $_SESSION['user_id'];

                $sql = "SELECT o.order_id, o.order_date, GROUP_CONCAT(CONCAT(mi.item_name, ' (', oi.quantity, ')') SEPARATOR ', ') AS items_info, 
                       GROUP_CONCAT(mi.item_price * oi.quantity) AS item_prices, o.total_amount
                FROM orders o
                JOIN order_items oi ON o.order_id = oi.order_id
                JOIN menu_items mi ON oi.item_id = mi.item_id
                WHERE o.customer_id = '$customer_id'
                GROUP BY o.order_id
                ORDER BY o.order_date DESC;";
                $result = $conn->query($sql);

                if ($result->num_rows === 0) {
                    echo '<h1 id="empty">No Orders Yet</h1>';
                } else {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="order">';
                        echo '<h2>Order ID: ' . $row["order_id"] . '</h2>';
                        echo '<p>Order Date: ' . $row["order_date"] . '</p>';
                        echo '<p>Items: ' . $row["items_info"] . '</p>';
                        $item_prices = explode(',', $row["item_prices"]);
                        echo '<p>';
                        foreach ($item_prices as $item_price) {
                            echo '৳' . number_format($item_price, 2) . ' +   ';
                        }
                        echo '</p>';
                        echo '<p>Total Amount: ৳' . number_format($row["total_amount"], 2) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </section>
        </main>


    </div>
</body>
<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>