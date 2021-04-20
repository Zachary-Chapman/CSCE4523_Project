<?php

//Connect to our MySQL database using the PDO extension.
$pdo = new PDO('mysql:host=localhost;dbname=rjnadwod', 'rjnadwod', 'eic0ahSh');

//Our select statement. This will retrieve the data that we want.
$sql = "SELECT TeamName FROM TEAM";

//Prepare the select statement.
$stmt = $pdo->prepare($sql);

//Execute the statement.
$stmt->execute();

//Retrieve the rows using fetchAll.
$teams = $stmt->fetchAll();

?>

<html>
    <body>
        <h3>Enter Game Details:</h3>
        <form action="add_game.php" method="post" style="margin-bottom: 10px">
            Team One: <select name="teamone" style="margin-bottom: 10px">
                <?php foreach($teams as $team1): ?>
                    <option name ="team1" value="<?= $team1['TeamID']; ?>"><?= $team1['TeamName']; ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            Team Two: <select name="teamtwo" style="margin-bottom: 10px">
                <?php foreach($teams as $team2): ?>
                    <option name="team2" value="<?= $team2['TeamID']; ?>"><?= $team2['TeamName']; ?></option>
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