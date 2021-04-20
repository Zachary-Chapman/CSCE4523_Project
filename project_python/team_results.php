<html>
    <body>
        <h3>Results by Team:</h3>
        <form action="team_results.php" method="post" style="margin-bottom: 10px">
            TeamName: <input type="text" name="teamname" style="margin-bottom: 10px">
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
    $command = 'python3 team_results.py' . ' ' . $teamname;

    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>";
    system($escaped_command);
}
?>
