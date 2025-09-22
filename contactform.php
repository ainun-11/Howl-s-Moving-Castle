<!DOCTYPE html>
<html>

<head>
    <title>Thank You!</title>
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

        .thank-you {
            font-size: 24px;
            color: #3c763d;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include "dbcon.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $sql = "INSERT INTO inquiries (con_name, con_email, inquiry_text)
                    VALUES ('$name', '$email', '$message')";
            $run = mysqli_query($conn, $sql);

            if ($run) {
                echo '<p class="thank-you">Thank you for contacting us!</p>';
                header("Refresh: 3; URL=landing.php");
            } else {
                echo '<p class="error">Error: ' . $sql . '<br>' . $conn->error . '</p>';
            }
        }

        $conn->close();
        ?>
    </div>
</body>

</html>