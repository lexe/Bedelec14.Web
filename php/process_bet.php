<?php

include 'db_connect.php';
include 'functions.php';
include 'da.php';
sec_session_start();

if (isset($_SESSION["user_id"], $_SESSION["bet_game_id"], $_POST["score1"], $_POST["score2"])) {
    updateBet($mysqli, $_SESSION["bet_game_id"], $_SESSION["user_id"], $_POST["score1"], $_POST["score2"]);
    header("Location: ../pages/index.php?page=upcoming");
}
