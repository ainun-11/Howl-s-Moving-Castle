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
    <link rel="stylesheet" href="css/menu.css" />
    <title>HMC | Menu</title>
</head>

<body>

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
                        <li><a class="active" href="#">Menu</a></li>
                        <li><a href="cart.php">View Cart</a></li>
                        <li><a href="order_history.php">Order History</a></li>
                        <li><a href="about.php">About us</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </header>

    <div class="menu-container">
        <div class="menu-overlay">

            <?php

            $_SESSION["user_id"];
            $uid =  $_SESSION["user_id"];
            include "dbcon.php";


            $sql = "SELECT item_id, item_name, item_description, item_price, pic, status FROM menu_items";
            $result = $conn->query($sql);
            ?>





            <div class="menu-container">
                <div class="menu-overlay">
                    <?php
                    if ($result->num_rows === 0) {
                        
                        echo '<h2>No items available</h2>';
                    } else {

                        while ($row = $result->fetch_assoc()) {
                            if ($row["status"] == 1) { 
                                echo '<form method="post" action="add_to_cart.php">';
                                echo '<input type="hidden" name="item_id" value="' . $row["item_id"] . '">';
                                echo '<input type="hidden" name="customer_id" value="' . $_SESSION['user_id'] . '">';
                                echo '<input type="hidden" name="price" value="' . $row["item_price"] . '">';
                                echo '<div class="coffee-item">';
                                echo '<img src="./assets/menu/' . $row["pic"] . '.png" alt="' . $row["item_name"] . '" />';
                                echo '<h2>' . $row["item_name"] . '</h2>';
                                echo '<h3>' . $row["item_description"] . '</h3>';
                                echo '<h2>Price: ৳' . $row["item_price"] . '</h2>';
                                echo '<div class="quantity-container">';
                                echo '<label for="quantity">Quantity:</label>';
                                echo '<input type="number" name="quantity" value="1" min="1" class="quantity-input">';
                                echo '</div>';
                                echo '<button type="submit" class="add-to-cart" name="add_to_cart">Add to Cart</button>';
                                echo '</div>';
                                echo '</form>';
                            }
                        }
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
            <br />
            <br />

            <footer>
                <div class="gobackup"><a href="#top">Go back up!</a></div>
                <br />
                <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
            </footer>
</body>



</html>