<?php

//Connect to our MySQL database using the PDO extension.
$pdo = new PDO('mysql:host=localhost;dbname=rjnadwod', 'rjnadwod', 'eic0ahSh');

//Our select statement. This will retrieve the data that we want.
$sql = "SELECT * FROM TEAM";

//Prepare the select statement.
$statement = $pdo->prepare($sql);

//Execute the statement.
$statement->execute();

//Retrieve the rows using fetchAll.
$teams = $statement->fetchAll();

?>

<html>
    <body>
        <h3>Enter Game Results:</h3>

        <form action="add_result.php" method="post" style="margin-bottom: 10px">
            Game ID: <input type="number" name="gameID" style="margin-bottom: 10px"><br>
            Team One: 
            <select name="teamOne" style="margin-bottom: 10px">
                <?php foreach($teams as $team1): ?>
                    <option value="<?= $team1['TeamID']; ?>">
                        <?= $team1['TeamName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            Team Two: 
            <select name="teamTwo" style="margin-bottom: 10px">
                <?php foreach($teams as $team2): ?>
                    <option value="<?= $team2['TeamID']; ?>">
                        <?= $team2['TeamName']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            Team One Score: <input type="number" name="teamOneScore" style="margin-bottom: 10px"><br>
            Team Two Score: <input type="number" name="teamTwoScore" style="margin-bottom: 10px"><br>
            Winner: <input type="text" name="winner" style="margin-bottom: 10px"><br>
            <input name="submit" type="submit" style="margin-bottom: 20px">
        </form>

        <form action="http://www.csce.uark.edu/~rjnadwod/project_python/home.html">
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
?>