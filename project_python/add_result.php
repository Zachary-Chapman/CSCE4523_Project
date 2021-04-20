<html>
    <body>
        <h3>Enter Game Results:</h3>

        <form action="add_result.php" method="post" style="margin-bottom: 10px">
            Game ID: <input type="number" name="gameID" style="margin-bottom: 10px"><br>
            Team One ID: <input type="number" name="teamOne" style="margin-bottom: 10px"><br>
            Team Two ID: <input type="number" name="teamTwo" style="margin-bottom: 10px"><br>
            Team One Score: <input type="number" name="teamOneScore" style="margin-bottom: 10px"><br>
            Team Two Score: <input type="number" name="teamTwoScore" style="margin-bottom: 10px"><br>
            Winner: <input type="text" name="winner" style="margin-bottom: 10px"><br>
            <input name="submit" type="submit" style="margin-bottom: 20px">
        </form>

        <form action="http://www.csce.uark.edu/~zachapma/project_python/home.html">
            <input type="submit" value="Return to Home Page" />
        </form>
        <br><br>

    </body>
</html>

<?php
if(isset($_POST['submit']))
{
    $gameID = escapeshellarg($_POST[gameID]);
    $teamOne = escapeshellarg($_POST[teamOne]);
    $teamTwo = escapeshellarg($_POST[teamTwo]);
    $teamOneScore = escapeshellarg($_POST[teamOneScore]);
    $teamTwoScore = escapeshellarg($_POST[teamTwoScore]);
    $winner = escapeshellarg($_POST[winner]);

    $command = 'python3 add_result.py' . ' ' . $gameID . ' ' . $teamOne . ' ' . $teamTwo . ' ' . $teamOneScore . ' ' . $teamTwoScore . ' ' . $winner;

    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>";
    system($escaped_command);
}