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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/cart.css" />
    <title>HMC | Cart</title>
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
                            <li><a class="active" href="#">View Cart</a></li>
                            <li><a href="order_history.php">Order History</a></li>
                            <li><a href="about.php">About us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>


        <main>
            <section class="cart-items">
                <?php
                include "dbcon.php";

                $customer_id = $_SESSION['user_id'];

                $sql = "SELECT ci.*, mi.item_name, mi.pic
                FROM cart_items ci
                JOIN menu_items mi ON ci.item_id = mi.item_id WHERE ci.customer_id = '$customer_id';";
                $result = $conn->query($sql);

                if ($result->num_rows === 0) {
                    echo '<h1 id="empty">Your Cart is Empty</h1>';
                } else {
                    echo '<section class="cart-items">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="cart-item">';
                        echo '<img src="./assets/menu/' . $row["pic"] . '.png" alt="Item ' . $row["item_name"] . '" />';
                        echo '<div class="item-details">';
                        echo '<h2>' . $row["item_name"] . '</h2>';
                        echo '<p class="price">৳' . $row["price"] . '</p>';
                        echo '<p class="quantity">Quantity: ' . $row["quantity"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '</section>';
                }
                ?>
            </section>

            <section class="total-section">
                <form method="post" action="checkout.php" class="checkout-form">
                    <div class="total-content">
                        <?php
                        $totalPrice = 0;
                        foreach ($result as $row) {
                            $totalPrice += $row["price"];
                        }
                        echo '<h2>Total: $' . number_format($totalPrice, 2) . '</h2>';
                        ?>
                    </div>
                    <button type="submit" class="checkout-button">Proceed to Checkout</button>
                </form>
            </section>
        </main>


        <br /><br />

    </div>

</body>
<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>