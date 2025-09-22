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
                        <li><a href="index.php">Home</a></li>
                        <li><a class="active" href="#">Menu</a></li>
                        <li><a href="about2.php">About us</a></li>
                        <li><a href="contact2.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </header>

    <div class="menu-container">
        <div class="menu-overlay">

            <?php
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
                                echo '<div class="coffee-item">';
                                echo '<img src="./assets/menu/' . $row["pic"] . '.png" alt="' . $row["item_name"] . '" />';
                                echo '<h2>' . $row["item_name"] . '</h2>';
                                echo '<h3>' . $row["item_description"] . '</h3>';
                                echo '<h2>Price: ৳' . $row["item_price"] . '</h2>';
                                echo '</div>';
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