<?php
require_once "dbcon.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: adminlogin.php");
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
    <title>Howl's Admin Panel!</title>
    <link rel="stylesheet" href="css/admin.css" />
</head>

<body>
    <div class="container">

        <img id="logo" src="assets/logo.png" alt="" /> </p>


        <header id="top">
            <section class="home">
                <div class="nav">
                    <div class="logo">
                        <h1>Howl's Moving Cafe</h1>
                    </div>
                    <div>
                        <ul>
                            <li><a href="add_item.php">Add Items</a></li>
                            <li><a href="remove_item.php">Edit Items</a></li>
                            <li><a href="editabout.php">Edit About Us</a></li>
                            <li><a href="inquiries.php">Inquiries</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>

        <section class="grid" id="grid">
            <div class="content">
                <div class="content-left">
                    <div class="info">
                        <h2>Welcome to the admin dashboard! <br /></h2>
                        <p>Please use the navbar or the buttons to your left to manage the cafe.</p>
                    </div>
                </div>
                <div class="content-right">
                    <div class="but">
                        <br /><br />
                        <button class="login"><a href="add_item.php">Add Items</a></button>
                        <button class="login"><a href="remove_item.php">Edit Item</a></button>
                        <button class="login"><a href="editabout.php">Edit About Us</a></button>
                        </button>
                        <button class="login"><a href="inquiries.php">Inquiries</a></button>

                        <br />
                        <br>

                        <button id="logout" class="login"><a href="logout.php">Log out</button>
                    </div>
                </div>
            </div>
        </section>

    </div>
</body>
<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>