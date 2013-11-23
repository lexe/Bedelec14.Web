<?php

function getScoreBoard($mysqli) {
    $users = getUsers($mysqli);
    $games = getPlayedGames($mysqli);
    foreach ($games as $game) {
        $bets = getBetsByGame($mysqli, $game->getID());
        foreach ($bets as $bet) {
            $users[$bet->getUserID()]->setScore(getScore($game, $bet));
        }
    }
    return $users;
}

function getScore(Game $game, Bet $bet) {
    if ($game->getScoreTeam1() == -1 || $game->getScoreTeam2() == -1) {
        return 0;
    }
    
    if ($bet->getScoreTeam1() == $game->getScoreTeam1() && $bet->getScoreTeam2() == $game->getScoreTeam2()) {
        return 2;
    }
    else if ($bet->getScoreTeam1() > $bet->getScoreTeam2() && $game->getScoreTeam1() > $game->getScoreTeam2()) {
                echo "1";
        return 1;
    }
    else if ($bet->getScoreTeam1() < $bet->getScoreTeam2() && $game->getScoreTeam1() < $game->getScoreTeam2()) {
                echo "2";
        return 1;
    }
    else if ($bet->getScoreTeam1() == $bet->getScoreTeam2() && $game->getScoreTeam1() == $game->getScoreTeam2()) {
                echo $game->getID();
        return 1;
    }
    
    return 0;
}

function getUsers($mysqli) {
    $result = $mysqli->query("CALL GetUsers");
    if ($result) {
        $retVal = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $user = mapUser($row);
            $retVal[$user->getID()] = $user;
        }
        $result->close();
        $mysqli->next_result();
       
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
        $result->close();
        $mysqli->next_result();
        
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
        $result->close();
        $mysqli->next_result();
        
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
        $result->close();
        $mysqli->next_result();
        
        return $retVal;
    }
}
function getBetsByGame($myqsli, $gameID) {
    $stmt = $myqsli->prepare("SELECT * FROM Bets WHERE GameID=?");
    if ($stmt) {
        $stmt->bind_param("i", $gameID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $retVal = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $bet = mapBet($row);
            $retVal[$bet->getUserID()] = $bet;
        }
        return $retVal;
    }
}
function getBet($myqsli, $gameID, $userID) {
    $stmt = $myqsli->prepare("SELECT * FROM Bets WHERE GameID=? AND UserID=?");
    if ($stmt) {
        $stmt->bind_param("ii", $gameID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            return mapBet($result->fetch_assoc());  
        }
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
    function getResult() {
        if ($this->scoreTeam1 >= 0 && $this->scoreTeam2 >= 0) {
            return $this->scoreTeam1 . " - " . $this->scoreTeam2;
        }
        else {
            return "--";
        }
    }
}
function mapGame($row) {
    $game = new Game();
    $game->setID($row["ID"]);
    $game->setDate(new DateTime($row["Date"], new DateTimeZone("Europe/Brussels")));
    $game->setTeam1ID($row["Team1ID"]);
    $game->setTeam2ID($row["Team2ID"]);
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
    function getProno() {
        if ($this->scoreTeam1 >= 0 && $this->scoreTeam2 >= 0) {
            return $this->scoreTeam1 . " - " . $this->scoreTeam2;
        }
        else {
            return "--";
        }
    }
}
function mapBet($row) {
    $bet = new Bet();
    $bet->setGameID($row["GameID"]);
    $bet->setUserID($row["UserID"]);
    $bet->setScoreTeam1($row["ScoreTeam1"]);
    $bet->setScoreTeam2($row["ScoreTeam2"]);
    
    return $bet;
}