<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>HMC | Admin Login</title>
</head>

<body>
    <div class="login-container">
        <h1>Welcome to Howl's Moving Cafe!</h1>
        <br>
        <h2>Login</h2>
        <br>

        <?php
        session_start();

        
        include "dbcon.php";


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $user = $_POST['user'];
            $password = $_POST['password'];

            
            $query = "SELECT * FROM admins WHERE username = '$user' AND password = '$password'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                
                $_SESSION['user_id'] = $user['admin_id'];

                
                $_SESSION['login_success'] = true;
                echo '<script>alert("Login successful!");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "admin.php"; }, 20);</script>';
            } else {
                
                $_SESSION['login_success'] = false;
                echo '<script>alert("Invalid email or password.");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "adminlogin.php"; }, 20);</script>';
            }
        }
        $conn->close();
        ?>

        <form action="adminlogin.php" method="POST">
            <label for="user">Username:</label>
            <input type="text" id="user" name="user" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <br>
        <button id="home" class="login"><a href="index.php">Home</a></button>
    </div>
</body>

</html>