<form action="../php/process_bet.php" method="post" name="bet_form">
    <table>
        <tr>
            <?php
            $teams = getTeams($mysqli);
            $game = getGame($mysqli, $_GET["game_id"]);
            $_SESSION["bet_game_id"] = $game->getID();

            echo "<td class='editBetHeader'>" . $teams[$game->getTeam1ID()]->getName() . "</td>";
            echo "<td class='editBetHeader'>" . $teams[$game->getTeam2ID()]->getName() . "</td>";
            ?>
        </tr>
        <tr>
            <td class="editBet"><input class="inputBet" type="number" name="score1" min="0" max="10" /></td>
            <td class="editBet"><input class="inputBet" type="number" name="score2" min="0" max="10" /></td>
        </tr>
    </table>
    <center><input type="submit" value="PlaceBet" /></center>
</form>