<html>
<head>
    <meta charset="UTF-8">
    <title>WK2014: Bedelec prono's</title>
</head>
<body>
    <?php
    include "functions.php";
    include "da.php";
    sec_session_start();
    
    $users = getUsers($mysqli);
    foreach($users as $id => $user) {
        echo $user->getName();
    }
    ?>
</body>
</html>

