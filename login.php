<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <title>HMC | Login</title>
</head>

<body>

    <div class="login-container">
        <h1>Welcome to Howl's Moving Cafe!</h1>
        <br />
        <h2>Login</h2>
        <br />
        <?php
        session_start();

        
        include "dbcon.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $email = $_POST['email'];
            $password = $_POST['password'];

            
            $query = "SELECT * FROM customers WHERE email = '$email'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();

                
                if (password_verify($password, $user['password'])) {
                    
                    $_SESSION['user_id'] = $user['customer_id'];

                    
                    $_SESSION['login_success'] = true;
                    echo '<script>alert("Login successful!");</script>';
                    echo '<script>setTimeout(function(){ window.location.href = "landing.php"; }, 20);</script>';
                } else {
                    
                    $_SESSION['login_success'] = false;
                    echo '<script>alert("Invalid email or password.");</script>';
                    echo '<script>setTimeout(function(){ window.location.href = "login.php"; }, 20);</script>';
                }
            } else {
                
                $_SESSION['login_success'] = false;
                echo '<script>alert("Invalid email or password.");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "login.php"; }, 20);</script>';
            }
        }
        $conn->close();
        ?>

        <form action="login.php" method="POST">
            <label for="Email">Email:</label>
            <input type="text" id="email" name="email" required />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">Login</button>
        </form>
        <br />
        <button id="logout" class="login"><a href="index.php">Home</a></button>
    </div>
</body>

</html>