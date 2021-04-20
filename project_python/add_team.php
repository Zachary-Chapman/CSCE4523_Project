<html>
    <body>
        <h3>Enter team details:</h3>

        <form action="add_team.php" method="post" style="margin-bottom: 10px">
            TeamName: <input type="text" name="name" style="margin-bottom: 10px"><br>
            Nickname: <input type="text" name="nickname" style="margin-bottom: 10px"><br>
            Rank: <input type="number" name="rank" style="margin-bottom: 10px"><br>
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
    $teamname = escapeshellarg($_POST[teamname]);
    $nickname= escapeshellarg($_POST[nickname]);
    $rrank = escapeshellarg($_POST[rank]);

    $command = 'python3 insert_new_item.py' . ' '.  $teamname . ' ' . $nickname . ' ' . $rank;

    // remove dangerous characters from command to protect web server
    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>"; 
    // run insert_new_item.py
    system($escaped_command);           
}
?>