<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            echo $user;
        ?>
    </title>
    <link rel="stylesheet" href="assets/CSS/users.css">
</head>
<body>

    <div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
    </div>

    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

    <div id = "greetings" style="text-align">
        <?php
            echo "Hello " . $user;
        ?>
    </div>

    <script>
    function openNav() {
        document.getElementById("myNav").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("myNav").style.width = "0%";
    }
    </script>
</body>
</html>