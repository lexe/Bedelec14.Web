<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>WK2014: Bedelec prono's</title>
</head>
<body>
    <?php
    if(isset($_GET['error'])) {
        echo 'Error login in!';
    }
    ?>
    
    <form action="php/process_login.php" method="post" name="login_form">
        Username: <input type="text" name="userName"/><br />
        Password: <input type="password" name="password" id="password" /><br />
        <input type="submit" value="Login" />
    </form>
</body>
</html>