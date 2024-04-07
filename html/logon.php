<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style type="text/css">
        body {
            background-color: #0b51d8;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            text-align: left;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #0b51d8;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0b51d8;
        }

        .create-account {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .create-account a {
            text-decoration: none;
            color: #0b51d8;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>

    <script>
        function Validate() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            if (username === "" || password === "") {
                alert("Please provide both username and password");
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
            session_start();

            if( isset($_SESSION['user']) && $_SESSION['user']!="" ){
               header("Location: home.php");
            }
            include_once 'connect.php';

            if ( isset($_POST['sca']) ) {
                $username = trim($_POST['username']);
                $password = trim($_POST['pass']);
                $hashed_password = hash('sha256', $password);

                $query = "SELECT userid, username, pass FROM people WHERE username=?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$username]);
                $count = $stmt->rowCount();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if( $count == 1 && $row['pass'] == $hashed_password ) {
                    $_SESSION['user'] = $row['userid'];
                    header("Location: home.php");
                    exit;
                }
                else {
                    $message = "Invalid Login";
                }
                $_SESSION['message'] = $message;
            }
        ?>
        <form action="logon.php" method="post" name="loginForm" onsubmit="return Validate()">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">

            <label for="password">Password:</label>
            <input type="password" name="pass" id="password">

            <input type="submit" name="sca" value="Login">

            <div class="create-account">
                <a href="register.php">Create an account</a>
            </div>
        </form>
        <?php
            if (isset($message)) {
                echo '<div class="error-message">' . $message . '</div>';
            }
        ?>
    </div>
</body>
</html>


