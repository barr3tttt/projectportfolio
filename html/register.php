<?php
session_start();

if( isset($_SESSION['user'])!="" ){
header("Location: home.php");
}

include_once 'connect.php';

if ( isset($_POST['sca']) ) {
  $fname = trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $email = trim($_POST['email']);
  $username = trim($_POST['username']);
  $pass = trim($_POST['pass']);
  $password = hash('sha256', $pass);

  $query = "insert into people(fname,lname,email,username,pass) values(?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$fname,$lname,$email,$username,$password]);
  $rowsAdded = $stmt->rowCount();

  if ($rowsAdded == 1) {
    $message = "Success! Proceed to login";
    unset($fname);
    unset($lname);
    unset($email);
    unset($pass);
    header("Location: logon.php");
  }
  else
  {
    $message = "Failed! For some reason";
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Create Your Account</title>
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
    position: relative;
    font-family: 'Roboto', sans-serif;
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
    font-size: 14px;
}

input[type="submit"] {
    background-color: #0b51d8;
    color: #fff;
    cursor: pointer;
    padding: 22px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    margin-top: 15px;
    margin-bottom: -10px;
}

input[type="submit"]:hover {
    background-color: #0b51d8;
}

#password-strength {
    margin-top: 1px;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    position: center;
    left: -20px;
    right: -20px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}

#password-match {
    margin-top: 1px;
    font-size: 14px;
    text-align: center;
    position: center;
    left: -20px;
    right: -20px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
</style>
<script>
function Validate() {
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
 	    var w = document.forms["accountcreate"]["email"].value;
            if (w == "") {
                alert("Please choose a email");
                return false;
            }
            var z = document.forms["accountcreate"]["username"].value;
            if (z == "") {
                alert("Please provide your username");
                return false;
            }
            var p = document.forms["accountcreate"]["pass"].value;
            if (p == "") {
                alert("Please provide your password");
                return false;
            }
            plength = p.length;
            if (plength < 8) {
                alert("Your password is not long enough");
                return false;
            }
            var vp = document.forms["accountcreate"]["vpass"].value;
            if (vp != p) {
                alert("Passwords do not match");
                return false;
            }
        }

        function checkPasswordStrength() {
            var password = document.getElementById("password").value;
            var strengthText = document.getElementById("password-strength");

            if (password.length < 5) {
                strengthText.textContent = "Password Strength: Very Weak";
                strengthText.style.color = "red";
            } else if (password.length < 8) {
                strengthText.textContent = "Password Strength: Weak";
                strengthText.style.color = "orange";
            } else if (password.length < 12) {
                strengthText.textContent = "Password Strength: Good";
                strengthText.style.color = "green";
            } else {
                strengthText.textContent = "Password Strength: Strong";
                strengthText.style.color = "blue";
            }
        }

        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var vpassword = document.getElementById("vpassword").value;
            var matchText = document.getElementById("password-match");

            if (password != vpassword) {
                matchText.textContent = "Passwords do not match";
                matchText.style.color = "red";
            } else {
                matchText.textContent = "Passwords match";
                matchText.style.color = "green";
            }
        }
    </script>
</head>
<body>
<div>
<h1>Create Your Account</h1>
<form action="register.php" method="post" name="accountcreate" onsubmit="return Validate()">
    <label for="fname">First Name:</label>
    <input type="text" name="fname" id="fname" required><br><br>
    
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" id="lname" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>
    
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    
    <label for="pass">Password:</label>
    <input type="password" name="pass" id="password" onkeyup="checkPasswordStrength()" required>
    <span id="password-strength"></span><br><br>
    
    <label for="vpass">Verify Password:</label>
    <input type="password" name="vpass" id="vpassword" onkeyup="checkPasswordMatch()" required>
    <span id="password-match"></span><br><br>
    
    <input type="submit" name="sca" value="Create Account"><br>
</form>
</div>
</body>
</html>

