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
        <h3>Enter Game Details:</h3>
        <form action="add_game.php" method="post" style="margin-bottom: 10px">
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
            </select>
            <br>
            Location: <input type="text" name="location" style="margin-bottom: 10px"><br>
            Date: <input type="date" name="date" style="margin-bottom: 10px"><br>
            <input name="submit" type="submit" style="margin-bottom: 20px">
        </form>

        <form action="http://www.csce.uark.edu/~rjnadwod/project_python/home.html">
            <input type="submit" value="Return to Home Page" />
        </form>
        <br><br>

    </body>
</html>

<?php
if (isset($_POST['submit'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $teamone = escapeshellarg($_POST[teamOne]);
    $teamtwo = escapeshellarg($_POST[teamTwo]);
    $location = escapeshellarg($_POST[location]);
    $date = escapeshellarg($_POST[date]);

    $command = 'python3 add_game.py' . ' '.  $teamone . ' ' . $teamtwo . ' ' . $location . ' ' . $date;

    // remove dangerous characters from command to protect web server
    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>"; 
    // run add_team.py
    system($escaped_command);           
}
?>