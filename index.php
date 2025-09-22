<?php
session_start();
require_once "dbcon.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT admin_id, username FROM admins WHERE admin_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $admin_id = $row['admin_id'];
        $username = $row['username'];

        
        if ($admin_id === 1) {
            header("Location: admin.php");
            exit();
        } else {
            header("Location: landing.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Howl's Moving Cafe!</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <div class="container">
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
                            <li><a href="menu2.php">Menu</a></li>
                            <li><a href="about2.php">About us</a></li>
                            <li><a href="contact2.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>

        <section class="grid" id="grid">
            <div class="content">
                <div class="content-left">
                    <div class="info">
                        <h2>Coffee to get you moving! <br /></h2>
                        <p>We get you the goods where ever you are or visit us for a cup of coffee at our moving Cafe!</p>
                    </div>
                    <div class="visit">
                        <button><a href="menu2.php"> View the Menu</a></button> <button><a href="contact2.html">Tell us what you think!</a></button>
                    </div>
                </div>
                <div class="content-right">
                    <div>
                        <button class="login"><a href="login.php">Log in</a></button>
                        <button class="signup"><a href="signup.html">Sign up</a></button>
                    </div>
                </div>
            </div>
        </section>


    </div>
</body>
<footer>
    <a class="ad" style="color: white; text-decoration: none;" href="admin.php">
        <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
    </a>

</footer>

</html>