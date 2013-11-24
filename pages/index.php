<html>
<head>
    <meta charset="UTF-8">
    <title>WK2014: Bedelec prono's</title>
    
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
    <?php
    include "../php/da.php";
    include "../php/db_connect.php";
    include "../php/functions.php";
    sec_session_start();
    
    if (login_check($mysqli) == false) {
        header("Location: ../index.php");
    }
    ?>
    
    <div id="main">
        <div id="menu">
            <center>
                <img src="../images/ball.jpg" width="120px"/><br>
            </center>
            <br>
            <a href="index.php?page=scoreboard"><button class="menu">Scorebord</button></a><br>
            <a href="index.php?page=upcoming"><button class="menu">Komende matsn</button></a><br>
            <a href="index.php?page=played"><button class="menu">Gespeelde matsn</button></a><br>
            <center>
                Ingelogd als <?php echo $_SESSION["user_name"]; ?><br>
                <a href="../php/process_logout.php">Logout</a>
            </center>
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
    </div>
</body>
</html>

