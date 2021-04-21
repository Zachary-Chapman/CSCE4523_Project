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
        <h3>Results by Team:</h3>
        <form action="team_results.php" method="post" style="margin-bottom: 10px">
        Team Name: 
            <select name="teamname" style="margin-bottom: 10px">
                <?php foreach($teams as $team1): ?>
                    <option value="<?= $team1['TeamName']; ?>">
                        <?= $team1['TeamName']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <input name="submit" type="submit" style="margin-bottom: 20px">
        </form>
        
        <br>

        <form action="http://www.csce.uark.edu/~rjnadwod/project_python/home.html">
            <input type="submit" value="Return to Home Page" />
        </form>

    </body>
</html>

<?php
if(isset($_POST['submit']))
{
    $teamname = escapeshellarg($_POST[teamname]);
    echo "$teamname";
    $command = 'python3 team_results.py' . ' ' . $teamname;

    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>";
    system($escaped_command);
}
?>
