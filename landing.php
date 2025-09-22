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

    $query = "SELECT first_name FROM customers WHERE customer_id  = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
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
    <title>Howl's Moving Cafe!</title>
    <link rel="stylesheet" href="css/index2.css" />
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

                            <li><a class="active" href="#">Home</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li><a href="cart.php">View Cart</a></li>
                            <li><a href="order_history.php">Order History</a></li>
                            <li><a href="about.php">About us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>

        <section class="grid" id="grid">
            <div class="content">
                <div class="content-left">
                    <div class="info">
                        <h2>A Coffee to get you moving! <br /></h2>
                        <p>We get you the goods where ever you are or visit us for a cup of coffee at our moving Cafe!</p>
                    </div>
                    <div class="visit">
                        <button><a href="menu.php"> View the Menu</a></button> <button><a href="contact.php">Tell us what you think!</a></button>
                    </div>
                </div>
                <div class="content-right">
                    <div>
                                            <h1>Welcome to Howl's Moving Cafe, <div style="color: orange; display: inline;"><?php echo $first_name; ?></div>!</h1>
                    </div>
                    <button id="logout" class="login"><a href="logout.php">Log out</a></button>
                </div>
            </div>
        </section>
    </div>
</body>

<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>