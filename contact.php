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
    <link rel="stylesheet" href="css/contact.css" />
    <title>HMC | Contact</title>
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
                            <li><a href="order_history.php">Order History</a></li>
                            <li><a href="about.php">About us</a></li>
                            <li><a class="active" href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>

        <main>
            <section class="contact">
                <div class="contact-info">
                    <h2>Get in Touch</h2>
                    <p>If you have any questions or feedback, feel free to reach out to us. We'd love to hear from you!</p>
                    <ul>
                        <li>Email: contact@onlinecafe.com</li>
                        <li>Phone: (123) 456-7890</li>
                        <li>Address: 123 Cafe Street, Cityville</li>
                    </ul>
                </div>
                <div class="contact-form">
                    <h2>Contact Form</h2>
                    <form action="contactform.php" method="POST">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required />

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required />

                        <label for="message">Message</label>
                        <input type="text" id="message" name="message" rows="4" required></input>

                        <button type="submit">Send Message</button>
                    </form>
                </div>
            </section>
        </main>

        <br /><br />
    </div>
</body>

<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>