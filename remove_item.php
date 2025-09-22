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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin | Edit Items</title>

    <style>
        .remove {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }


        .remove label,
        .remove select {
            display: block;
            margin-bottom: 10px;
        }

        .remove select {
            text-align: center;
            width: 40%;
            padding: 8px;
            font-size: 16px;
        }
    </style>


</head>

<body>
    <div class="contaier">
        <img id="logo" src="assets/logo.png" alt="">

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
            <div class="container-removeitem">
                <h2>Edit Item Status in the Menu</h2>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
                    $item_id = $_POST['item_id'];
                    $status = $_POST['status'];

                    
                    include "dbcon.php";
                    $sql = "UPDATE menu_items SET status = $status WHERE item_id = '$item_id'";
                    if ($conn->query($sql) === TRUE) {
                        $item_name_query = "SELECT item_name FROM menu_items WHERE item_id = '$item_id'";
                        $result_name = $conn->query($item_name_query);
                        $item_name = "Unknown Item";
                        if ($result_name->num_rows > 0) {
                            $row_name = $result_name->fetch_assoc();
                            $item_name = $row_name['item_name'];
                        }

                        echo "<p>Item with ID $item_id (Name: $item_name) has been updated. Status: $status</p>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
                include "dbcon.php";
                $sql = "SELECT item_id, item_name, status FROM menu_items";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<form class="remove" action="remove_item.php" method="post">';
                    echo '<label for="item_id">Select Item to Modify:</label>';
                    echo '<select id="item_id" name="item_id" required>';
                    echo '<option value="" disabled selected>Select an item</option>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['item_id'] . '">' . $row['item_name'] . '</option>';
                    }

                    echo '</select>';

                    echo '<label for="status">Select Status:</label>';
                    echo '<select style="width: 20%;" id="status" name="status" required>';
                    echo '<option value="1">Active</option>';
                    echo '<option value="0">Inactive</option>';
                    echo '</select>';

                    echo '<button type="submit">Update Item Status</button>';
                    echo '</form>';
                } else {
                    echo "No items found in the menu.";
                }

                $conn->close();
                ?>
            </div>
        </main>
    </div>

</body>

<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>