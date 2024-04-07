<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create An Account</title>
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
            var w = document.forms["accountcreate"]["username"].value;
            if (w == "") {
                alert("Please choose a username");
                return false;
            }
            var x = document.forms["accountcreate"]["fname"].value;
            if (x == "") {
                alert("Please provide your First Name");
                return false;
            }
            var y = document.forms["accountcreate"]["lname"].value;
            if (y == "") {
                alert("Please provide your Last Name");
                return false;
            }
            var z = document.forms["accountcreate"]["email"].value;
            if (z == "") {
                alert("Please provide your email address");
                return false;
            }
            var p = document.forms["accountcreate"]["password"].value;
            if (p == "") {
                alert("Please provide your password");
                return false;
            }
            plength = p.length;
            if (plength < 10) {
                alert("Your password is not long enough");
                return false;
            }
        }
    </script>
</head>

<body>
    <div>
        <h1>Create Your Account</h1>
        <form action="home.php" method="post" name="accountcreate" onsubmit="return Validate()">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">

            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname">

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname">

            <label for="email">Email Address:</label>
            <input type="text" name="email" id="email">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Create Account">
        </form>
    </div>
</body>

</html>


