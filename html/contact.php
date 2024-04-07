<?php
session_start();
// Check if user is authenticated
if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
    header("Location: logon.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>About Me</title>
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

        .contact-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .contact-info a {
            text-decoration: none;
            color: #0b51d8;
            margin-bottom: 10px;
            display: block;
        }

        .edit-button {
            margin-top: 10px;
        }

        .edit-button a {
            text-decoration: none;
            color: #0b51d8;
            font-weight: bold;
        }

        .home-button {
            position: absolute;
            top: 20px; /* Adjust top position */
            left: 20px; /* Adjust left position */
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
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>About Me</h1>
            <p>Hello, I'm Barrett, and I hope you found my work interesting. My journey into cybersecurity began with a fascination for understanding the world, paired with a keen interest in technology. Currently, I work as a Technician at a local MSP, where I specialize in on-site repairs and troubleshooting of all sorts, placing me at the heart of the tech realm. I aspire to one day make meaningful contributions to the ever-evolving landscape of cybersecurity.</p>
        </div>
        <div class="box">
            <h1>Contact Information</h1>
            <p>Email: bacaywood@hotmail.com</p>
            <p><a href="https://www.linkedin.com/in/barrettcaywood/">LinkedIn</a></p>
            <p><a href="https://github.com/BarrettCaywood">GitHub</a></p>
        </div>
    </div>
    <button class="home-button" onclick="window.location.href='home.php'"><img src="homebutton.png" alt="Home">Home</button>
</body>
</html>



