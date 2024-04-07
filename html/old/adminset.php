<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'connect.php';
require_once 'password.php'; 

$message = "";

if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
    header("Location: logon.php");
    exit;
}

$query = "SELECT * FROM people WHERE userid=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user']]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user is not an administrator, redirect to landing.php if not
if ($userRow['role'] !== 'administrator') {
    header("Location: landing.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_username"])) {
    $new_username = trim($_POST["new_username"]);
    if (!empty($new_username)) {
        $update_query = "UPDATE people SET username=? WHERE userid=?";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([$new_username, $_SESSION['user']]);
        $userRow['username'] = $new_username;
        $message = "Username Saved";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_email"])) {
    $new_email = trim($_POST["new_email"]);
    if (!empty($new_email)) {
        $update_query = "UPDATE people SET email=? WHERE userid=?";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([$new_email, $_SESSION['user']]);
        $userRow['email'] = $new_email;
        $message = "Email Saved"; 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_password"])) {
    $new_password = trim($_POST["new_password"]);
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE people SET pass=? WHERE userid=?";
        $update_stmt = $pdo->prepare($update_query);
        if ($update_stmt->execute([$hashed_password, $_SESSION['user']])) {
            $message = "Password Saved";
        } else {
            $message = "Error saving password: " . implode(", ", $update_stmt->errorInfo());
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save_role"])) {
    $new_role = $_POST["new_role"];
    $update_query = "UPDATE people SET role=? WHERE userid=?";
    $update_stmt = $pdo->prepare($update_query);
    if ($update_stmt->execute([$new_role, $_SESSION['user']])) {
        $userRow['role'] = $new_role;
        $message = "Role Saved";
    } else {
        $message = "Error saving role: " . implode(", ", $update_stmt->errorInfo());
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Settings</title>
<style type="text/css">
body {
    background-image: url('bakk.png');
    background-size: cover;
    background-position: center;
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
    min-height: 100vh;
    position: relative;
}

.container {
    width: 600px;
    padding: 20px;
    text-align: center;
    margin: 0 auto;
}

.box {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

form {
    text-align: left;
    margin-bottom: 20px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="submit"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #0b51d8;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
}

input[type="submit"]:hover {
    background-color: #063aa3;
}

.home-button {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 5px 10px;
    background-color: #0b51d8;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.home-button img {
    width: 20px;
    height: 20px;
    margin-right: 5px;
    vertical-align: middle;
}

.message {
    color: green;
    margin-top: 10px;
}
</style>
</head>
<body>
<div class="container">
<div class="box">
    <h1>Administrator Settings</h1>
    <p>Current Username: <?php echo htmlspecialchars($userRow['username']); ?></p>
    <form method="post" action="">
        <label for="new_username">New Username:</label><br>
        <input type="text" id="new_username" name="new_username" placeholder="Enter new username">
        <input type="submit" name="save_username" value="Save"><br>
    </form>
    <p>Current Email: <?php echo htmlspecialchars($userRow['email']); ?></p>
    <form method="post" action="">
        <label for="new_email">New Email:</label><br>
        <input type="email" id="new_email" name="new_email" placeholder="Enter new email">
        <input type="submit" name="save_email" value="Save"><br>
    </form>
    <form method="post" action="">
        <label for="new_password">New Password:</label><br>
        <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
        <input type="submit" name="save_password" value="Save"><br>
    </form>
    <form method="post" action="">
        <label for="new_role">Change Role:</label><br>
        <select id="new_role" name="new_role">
            <option value="user" <?php if ($userRow['role'] == 'user') echo 'selected'; ?>>User</option>
            <option value="administrator" <?php if ($userRow['role'] == 'administrator') echo 'selected'; ?>>Administrator</option>
        </select>
        <input type="submit" name="save_role" value="Save Role"><br>
    </form>
    <div class="message"><?php echo $message; ?></div> <!-- Display message here -->
</div>
</div>
<button class="home-button" onclick="window.location.href='home.php'"><img src="homebutton.png" alt="Home">Home</button>
</body>
</html>

