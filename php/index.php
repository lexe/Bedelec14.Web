<html>
<head>
    <meta charset="UTF-8">
    <title>WK2014: Bedelec prono's</title>
    
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php
    include "da.php";
    include "db_connect.php";
    include "functions.php";
    sec_session_start();
    
    if (login_check($mysqli) == false) {
        echo "Invalid session";
    }
    ?>
    
    <div id="menu">
        <center>
            <img src="../images/ball.jpg" width="120px"/><br>
        </center>
        <a href="index.php?page=scoreboard">Scorebord</a><br>
        <a href="index.php?page=upcoming">Komende matsn</a><br>
        <a href="index.php?page=played">Gespeelde matsn</a>
    </div>
    <div id="content">

        <?php
        if (isset($_GET["page"])) {
            include_once $_GET["page"] . ".php";
        }
        else {
            echo "Invalid page";
        }
        ?>

    </div>
</body>
</html>

