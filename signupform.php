<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <style>
        body {
            background: url(./assets/background/thanks.gif) no-repeat center center fixed;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.726);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .thank-you,
        .error {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .error {
            color: #a94442;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input,
        button {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        button {
            background-color: #337ab7;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        
        include "dbcon.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phoneNumber = $_POST['phoneNumber'];
            $address = $_POST['address'];


            $duplicateCheckQuery = "SELECT * FROM customers WHERE email = '$email' OR number = '$phoneNumber'";
            $duplicateCheckResult = mysqli_query($conn, $duplicateCheckQuery);

            if (mysqli_num_rows($duplicateCheckResult) > 0) {
                
                echo '<p class="error">Email or Phone Number is already in use. Please use a different one.</p>';
            } else {
                
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                
                $sql = "INSERT INTO customers (first_name, last_name, email, password, number, address)
                        VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$phoneNumber', '$address')";

                $run = mysqli_query($conn, $sql);

                if ($run) {
                    
                    echo '<p class="thank-you">Welcome Aboard!</p>';
                    header("Refresh: 3; URL=login.php");
                } else {
                    
                    echo '<p class="error">Something went wrong. Please try again later.</p>';
                }
            }
        }

        $conn->close();
        ?>
    </div>
</body>

</html>