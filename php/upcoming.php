<table>
    <tr class="header">
        <td class="upcoming1">Tijd</td>
        <td class="upcoming2">Team 1</td>
        <td class="upcoming3">Team 2</td>
        <td class="upcoming4">Prono</td>
    </tr>
    <?php
    $teams = getTeams($mysqli);
    $date = "";
    $prono = "";
    foreach(getUpcomingGames($mysqli) as $game) {
        echo "<tr>"
            . "<td class='upcoming1'>" . $game->getDate()->format("H:i") . "</td>"
            . "<td class='upcoming2'>" . $teams[$game->getTeam1ID()]->getName() . "</td>"
            . "<td class='upcoming3'>" . $teams[$game->getTeam2ID()]->getName() . "</td>"
            . "<td class='upcoming4'>" . $prono . "</td>"
            . "</tr>";
    }
    ?>
</table>
