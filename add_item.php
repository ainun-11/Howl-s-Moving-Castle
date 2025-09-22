<?php
require_once "dbcon.php";
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: adminlogin.php"); 
    exit();
}

$user_id = $_SESSION['user_id'];



$query = "SELECT admin_id, username FROM admins WHERE admin_id = $user_id";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $admin_id = intval($row['admin_id']);
    $username = trim($row['username']);

    $admin_accounts = array(
        array('id' => 1, 'username' => 'atika'),
        array('id' => 2, 'username' => 'ainun'),
        array('id' => 3, 'username' => 'shithy')
    ); 

    $is_admin = false;

    foreach ($admin_accounts as $admin) {
        if ($admin_id === $admin['id'] && $username === $admin['username']) {
            $is_admin = true;
            break;
        }
    }

    if ($is_admin) {
        
    } else {
        header("Location: landing.php");
        exit();
    }
} else {
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/admin.css" />
    <title>Admin | Add Item</title>
</head>

<body>
    <div class="contaier">

        <img id="logo" src="assets/logo.png" alt="" /> </p>


        <header id="top">
            <section class="home">
                <div class="nav">
                    <div class="logo">
                        <h1>Howl's Moving Cafe</h1>
                    </div>
                    <div>
                        <ul>
                            <li><a href="admin.php">Dashboard</a></li>
                            <li><a href="add_item.php">Add Items</a></li>
                            <li><a href="remove_item.php">Edit Item</a></li>
                            <li><a href="editabout.php">Edit About Us</a></li>
                            <li><a href="inquiries.php">Inquiries</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>




        <main>
            <div class="container-additem">
                <h2 id="add_item">Add New Item to Menu</h2>
                <br>

                <?php
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $item_name = $_POST["item_name"];
                    $description = $_POST["description"];
                    $price = $_POST["price"];
                    $pic = $_POST["pic"];

                    
                    include "dbcon.php";

                    
                    $sql = "INSERT INTO menu_items (item_name, item_description, item_price, pic) VALUES ('$item_name', '$description', $price, $pic)";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Item '$item_name' added to the menu.</p>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
                ?>

                <form action="add_item.php" method="post">
                    <label for="item_name" col>Item Name:</label>
                    <input rows="4" style="font-size: 2rem;" type="text" id="item_name" name="item_name" required><br><br>

                    <label for="description">Description:</label>
                    <br>
                    <textarea id="description" name="description" rows="6" style="font-size: 1.5rem;" cols="60"></textarea><br><br>

                    <label for="price">Price:</label>
                    <input style="font-size: 1.5rem;" type="number" id="price" name="price" step="0.01" required><br><br>

                    <label for="pic">Picture:</label>
                    <input style="font-size: 1.5rem;" type="number" id="pic" name="pic" step="1" required><br><br>

                    <button id="add_item" type="submit">Add Item</button>
                </form>
            </div>
        </main>
        <br /><br />
    </div>
</body>
<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>