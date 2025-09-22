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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="menu2.php">Menu</a></li>
                            <li><a class="active" href="#">About us</a></li>
                            <li><a href="contact2.html">Contact</a></li>
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