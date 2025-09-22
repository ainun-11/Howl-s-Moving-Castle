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
    <link rel="stylesheet" href="css/inquiries.css">
    <title>HMC | Inquiries</title>
</head>

<body>
    <div class="container">
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
                            <li><a class="active" href="#">Inquiries</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </header>

        <main>
            <section class="inquiries">
                <?php
                include "dbcon.php";

                
                $sql = "SELECT con_name, con_email, inquiry_date, inquiry_text FROM inquiries";
                $result = $conn->query($sql);

                if ($result->num_rows === 0) {
                    echo '<h1 id="empty">No Inquiries Yet</h1>';
                } else {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="inquiry">';
                        echo '<h2>Contact Name: ' . $row["con_name"] . '</h2>';
                        echo '<p>Contact Email: ' . $row["con_email"] . '</p>';
                        echo '<p>Inquiry Date: ' . $row["inquiry_date"] . '</p>';
                        echo '<p>Inquiry Text: ' . $row["inquiry_text"] . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </section>
        </main>
    </div>


</body>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>