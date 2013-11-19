<?php

include 'db_connect.php';
include 'functions.php';
sec_session_start();

if (isset($_POST['userName'], $_POST['password'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    if (login($userName, $password, $mysqli)) {
        header("Location: index.php?page=scoreboard");
    }
    else {
        echo 'Authentication failed';
    }
}