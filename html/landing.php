<!DOCTYPE html>
<html>
<head>
  <title>Barrett's Project Portfolio</title>
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
      padding: 3px 0;
      text-align: center;
      color: #0b51d8;
      font-size: 24px;
      font-weight: bold;
      position: relative;
    }
    .header-text {
      position: absolute;
      left: 40px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 28px;
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
      right: 85px;
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
    .settings {
      position: absolute;
      top: 38px;
      right: 30px;
      width: 50px;
      height: 50px;
    }
  </style>
</head>
<body>
  <header>
    <span style="color: #FFFFFF; margin-right: 20px;">Welcome, <?php echo $userRow['fname']; ?>!</span>
    <div class="header-text">Barrett's Project Portfolio</div>
    <a href="logout.php" class="logout">Logout</a>
    <div class="settings">
      <a href="index.php">
        <img src="back.png" alt="Back" style="width: 100%; height: 100%;">
      </a>
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

