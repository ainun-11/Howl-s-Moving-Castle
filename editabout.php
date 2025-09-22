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
    <title>Admin | Edit About us</title>
    <link rel="stylesheet" href="css/admin.css">
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
            <div class="container-editabout">
                <h2>Edit About Us</h2>

                <?php
                include "dbcon.php";

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $newAboutUsContent = $_POST["about_us_content"];
                    $updateSql = "UPDATE about_us_section SET content = '$newAboutUsContent' WHERE a_id = 1";
                    if ($conn->query($updateSql) === TRUE) {
                        echo "<div class='container-additem'>";
                        echo "<p>About Us content updated successfully.</p>";
                        echo "</div>";
                    } else {
                        echo "Error updating content: " . $conn->error;
                    }
                }

                $selectSql = "SELECT * FROM about_us_section WHERE a_id = 1";
                $result = $conn->query($selectSql);
                $aboutUsContent = "";
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $aboutUsContent = $row["content"];
                }

                $conn->close();
                ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="about_us_content">About Us Content:</label>
                    <br><br>
                    <textarea style="border-radius: .7rem;font-size: 1.4rem;" rows="19" cols="60" name="about_us_content" id="about_us_content" rows="8"><?php echo $aboutUsContent; ?></textarea>
                    <br><br>
                    <button type="submit">Save</button>
                </form>
            </div>
        </main>
    </div>

</body>

<footer>
    <p>&copy; 2023 Howl's Moving Cafe!. All rights reserved.</p>
</footer>

</html>