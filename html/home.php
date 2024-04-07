<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$query = "SELECT * FROM people WHERE userid=?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user']]);
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

$settingsPage = ($userRow['role'] == 'administrator') ? 'adminset.php' : 'settings.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars("Barrett's Project Portfolio"); ?></title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("bakk.png");
            background-size: cover;
        }

        header {
            background-color: #000000;
            padding: 0.1px 0;
            text-align: center;
            color: #0b51d8;
            font-size: 20px;
            font-weight: bold;
            position: relative;
        }

        .header-text {
            position: absolute;
            left: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 23px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            text-align: center;
        }

        .button {
            display: block;
            height: 200px;
            background-color: #000000;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            line-height: 200px;
            font-size: 20px;
            text-align: center;
        }

        .logout {
            position: absolute;
            top: 38px;
            right: 30px;
            background-color: #000000;
            color: #0b51d8;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout:hover {
            background-color: #0b51d8;
            color: #ffffff;
        }

        .subheader {
            text-align: center;
            margin-top: 20px;
        }

        .subheader .sub-button {
            display: inline-block;
            margin: 0 20px;
            background-color: #000000;
            color: #0b51d8;
            text-decoration: none;
            border-radius: 5px;
            padding: 9px 19px;
            font-size: 18px;
            transition: background-color 0.3s, color 0.3s;
        }

        .subheader .sub-button:hover {
            background-color: #0b51d8;
            color: #ffffff;
        }

        .subheader .sub-button.icon {
            background-size: cover;
            width: 5px;
            height: 30px;
            display: inline-block;
            vertical-align: middle;
        }

        .subheader .sub-button.back {
            background-image: url("settin.png");
            float: middle;
            width: 33px;
            height: 26px;
            padding: 10px 8px;
        }

        .subheader .sub-button.settings {
            background-image: url("logouticon.png");
        }

    </style>
</head>
<body>
<header>
    <div class="header-text">Welcome, <?php echo htmlspecialchars($userRow['fname']); ?>!</div>
    <h1><?php echo htmlspecialchars("Barrett's Project Portfolio"); ?></h1>
    <div class="subheader">
        <a href="logout.php" class="sub-button icon settings"></a>
        <a href="contact.php" class="sub-button">About Me</a>
        <?php if ($userRow['role'] == 'administrator') : ?>
            <a href="adminset.php" class="sub-button icon back"></a>
        <?php else : ?>
            <a href="setting.php" class="sub-button icon back"></a>
        <?php endif; ?>
    </div>
</header>
<div class="container">
    <a class="button" href="project1.php">Project 1</a>
    <a class="button" href="project2.php">Project 2</a>
    <a class="button" href="project3.php">Project 3</a>
    <a class="button" href="project4.php">Project 4</a>
</div>
</body>
</html>
