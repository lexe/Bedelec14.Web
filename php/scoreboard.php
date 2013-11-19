<table>
    <tr class="scoreboardHeader">
        <td class="scoreboard1">#</td>
        <td class="scoreboard2">Naam</td>
        <td class="scoreboard3">P</td>
    </tr>
    <?php
    $i = 1;
    foreach(getScoreBoard($mysqli) as $key => $user) {
        echo "<tr><td class='scoreboard1'>" . $i . "</td><td class='scoreboard2'>" . $user->getName() . "</td><td class='scoreboard3'>" . $user->getScore() . "</td></tr>";
        $i++;
    }
    ?>
</table>
