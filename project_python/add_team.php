<html>
    <body>
        <h3>Enter team details:</h3>

        <form action="add_team.php" method="post" style="margin-bottom: 10px">
            TeamName: <input type="text" name="teamname" style="margin-bottom: 10px"><br>
            Nickname: <input type="text" name="nickname" style="margin-bottom: 10px"><br>
            Rank: <input type="number" name="rank" style="margin-bottom: 10px"><br>
            <input name="submit" type="submit" style="margin-bottom: 20px">
        </form>

        <form action="http://www.csce.uark.edu/~zachapma/project_python/home.html">
            <input type="submit" value="Return to Home Page" />
        </form>
        <br><br>

    </body>
</html>

<?php
if (isset($_POST['submit'])) 
{
    // replace ' ' with '\ ' in the strings so they are treated as single command line args
    $teamname = escapeshellarg($_POST[teamname]);
    $nickname= escapeshellarg($_POST[nickname]);
    $rank = escapeshellarg($_POST[rank]);

    $command = 'python3 add_team.py' . ' '.  $teamname . ' ' . $nickname . ' ' . $rank;

    // remove dangerous characters from command to protect web server
    $escaped_command = escapeshellcmd($command);
    //echo "<p>command: $command <p>"; 
    // run add_team.py
    system($escaped_command);           
}
?>

<!-- SELECT t1.TeamName AS 'Team Name', t1.Nickname, 
r.GameID, r.ScoreOne AS 'Team Score', r.ScoreTwo AS 'Opponents Score', 
t2.TeamName AS 'Opponents Name', g.date FROM RESULT r
LEFT JOIN TEAM t1 ON r.TeamOneID = t1.TeamID
LEFT JOIN TEAM t2 ON r.TeamTwoID = t2.TeamID
LEFT JOIN GAME g ON r.GameID = g.GameID
WHERE t1.TeamName = 'Baylor'

UNION

SELECT t2.TeamName AS 'Team Name', t2.Nickname, 
r.GameID, r.ScoreOne AS 'Team Score', r.ScoreTwo AS 'Opponents Score', 
t1.TeamName AS 'Opponents Name', g.date FROM RESULT r
LEFT JOIN TEAM t1 ON r.TeamOneID = t1.TeamID
LEFT JOIN TEAM t2 ON r.TeamTwoID = t2.TeamID
LEFT JOIN GAME g ON r.GameID = g.GameID
WHERE t2.TeamName = 'Baylor'; -->