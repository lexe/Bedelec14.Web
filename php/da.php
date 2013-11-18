<?php

function getUsers($mysqli) {
    $result = $mysqli->query("CALL GetUsers");
    if ($result) {
        $retVal = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $user = mapUser($row);
            $retVal[$user->getID()] = $user;
        }
        return $retVal;
    }
}
function getTeams($mysqli) {
    $result = $mysqli->query("CALL GetTeams");
    if ($result) {
        $retVal = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $team = mapTeam($row);
            $retVal[$team->getID()] = $team;
        }
        return $retVal;
    }
}
function getUpcomingGames($mysqli) {
    $result = $mysqli->query("CALL GetUpcomingGames");
    if ($result) {
        $retVal = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $game = mapGame($row);
            $retVal[$game->getID()] = $game;
        }        
        return $retVal;
    }
}
function getPlayedGames($mysqli) {
    $result = $mysqli->query("CALL GetPlayedGames");
    if ($result) {
        $retVal = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $game = mapGame($row);
            $retVal[$game->getID()] = $game;
        }        
        return $retVal;
    }
}

class User {
    private $id;
    private $name;
    private $score;
    
    function getID() {
        return $this->id;
    }
    function setID($id) {
        $this->id = $id;
    }
    function getName() {
        return $this->name;
    }
    function setName($name) {
        $this->name = $name;
    }
    function getScore() {
        return $this->score;
    }
    function setScore($score) {
        $this->score = $score;
    }
}
function mapUser($row) {
    $user = new User();
    $user->setID($row["ID"]);
    $user->setName($row["Name"]);
    $user->setScore(0); 
    
    return $user;
}

class Team {
    private $id;
    private $name;
    
    function getID() {
        return $this->id;
    }
    function setID($id) {
        $this->id = $id;
    }
    function getName() {
        return $this->name;
    }
    function setName($name) {
        $this->name = $name;
    }
}
function mapTeam($row) {
    $team = new Team();
    $team->setID($row["ID"]);
    $team->setName($row["Name"]);
    
    return $team;
}

class Game {
    private $id; 
    private $date;
    private $team1ID;
    private $team2ID;
    private $scoreTeam1;
    private $scoreTeam2;
    
    function getID() {
        return $this->id;
    }
    function setID($id) {
        $this->id = $id;
    }
    function getDate() {
        return $this->date;
    }
    function setDate($date) {
        $this->date = $date;
    }
    function getTeam1ID() {
        return $this->team1ID;
    }
    function setTeam1ID($team1ID) {
        $this->team1ID = $team1ID;
    }
    function getTeam2ID() {
        return $this->team2ID;
    }
    function setTeam2ID($team2ID) {
        $this->team2ID = $team2ID;
    }
    function getScoreTeam1() {
        return $this->scoreTeam1;
    }
    function setScoreTeam1($scoreTeam1) {
        $this->scoreTeam1 = $scoreTeam1;
    }    
    function getScoreTeam2() {
        return $this->scoreTeam2;
    }
    function setScoreTeam2($scoreTeam2) {
        $this->scoreTeam2 = $scoreTeam2;
    }
}
function mapGame($row) {
    $game = new Game();
    $game->setID($row["ID"]);
    $game->setDate($row["Date"]);
    $game->setTeam1ID($row["Name"]);
    $game->setTeam2ID($row["Name"]);
    $game->setScoreTeam1($row["ScoreTeam1"]);
    $game->setScoreTeam2($row["ScoreTeam2"]);    
    
    return $game;
}

class Bet {
    private $userID;
    private $gameID;
    private $scoreTeam1;
    private $scoreTeam2;
    
    function getUserID() {
        return $this->userID;
    }
    function setUserID($userID) {
        $this->userID = $userID;
    }
    function getGameID() {
        return $this->gameID;
    }
    function setGameID($gameID) {
        $this->gameID = $gameID;
    }
    function getScoreTeam1() {
        return $this->scoreTeam1;
    }
    function setScoreTeam1($scoreTeam1) {
        $this->scoreTeam1 = $scoreTeam1;
    }    
    function getScoreTeam2() {
        return $this->scoreTeam2;
    }
    function setScoreTeam2($scoreTeam2) {
        $this->scoreTeam2 = $scoreTeam2;
    }
}