<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    
    require_once "dbcon.php";

    $query = "SELECT admin_id FROM admins WHERE admin_id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) { 
            $row = mysqli_fetch_assoc($result);
            $admin_id = $row['admin_id'];

            if ($admin_id === 1) {
                header("Location: admin.php");
                exit();
            }
        } else {
            
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
    <link rel="stylesheet" href="css/about.css" />
    <title>HMC | About Us</title>
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
                            <li><a href="landing.php">Home</a></li>
                            <li><a href="menu.php">Menu</a></li>
                            <li><a href="cart.php">View Cart</a></li>
                            <li><a href="order_history.php">Order History</a></li>
                            <li><a class="active" href="#">About us</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>
        <section class="about-us">
            <div class="about-text">
                <h1>About Us</h1>



                <?php
                
                include "dbcon.php";


                $sql = "SELECT content FROM about_us_section WHERE a_id = 1";
                $result = $conn->query($sql);

                $aboutUsContent = "";
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $aboutUsContent = $row["content"];
                }

                $conn->close();
                ?>

                <p><?php echo $aboutUsContent; ?></p>
            </div>
        </section>
    </div>

</body>

<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>