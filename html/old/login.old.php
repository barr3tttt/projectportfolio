<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style type="text/css">
        body {
            background-color: #06C3DC;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        div {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 1em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #0b51d8;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0b51d8;
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
    <div>
        <h1>Sign In</h1>
        <form action="home.php" method="post" name="loginForm" onsubmit="return Validate()">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>


