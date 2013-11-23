<table>
    <tr class="header">
        <td class="game1">Tijd</td>
        <td class="game2">Team 1</td>
        <td class="game3">Team 2</td>
        <td class="game4header">Prono</td>
    </tr>
    <?php
    $teams = getTeams($mysqli);
    $date = "";
    $dateGame = "";
    $prono = "";
    foreach(getUpcomingGames($mysqli) as $game) {
        // order by date
        $dateGame = $game->getDate()->format("d/m/Y");
        if ($date != $dateGame) {
            echo "</table>"
                . "\n<div class='date'>" . $dateGame . "</div>"
                . "\n<table>";
        }
        $date = $dateGame;
        
        // get prono
        $bet = getBet($mysqli, $game->getID(), $_SESSION['user_id']);
        if ($bet) {
            $prono = $bet->getProno();
        }
        else {
            $prono = "--";
        }
        
        // add game to list
        echo "\n<tr>"
            . "<td class='game1'>" . $game->getDate()->format("H:i") . "</td>"
            . "<td class='game2'>" . $teams[$game->getTeam1ID()]->getName() . "</td>"
            . "<td class='game3'>" . $teams[$game->getTeam2ID()]->getName() . "</td>"
            . "<td class='game4'><a href='index.php?page=edit_bet&game_id=". $game->getID() . "'>" . $prono . "</a></td>"
            . "</tr>\n";
    }
    ?>
</table>
