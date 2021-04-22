<html>
    <body>
        <form action="view_teams.php" method="get" style="padding-bottom:10px">
            <input type="submit" name="submit" value="Click to View Teams"/>
        </form>

        <?php
        if (isset($_GET['submit'])) 
        {
            // replace ' ' with '\ ' in the strings so they are treated as single command line args
            $teamname = escapeshellarg($_POST[teamname]);
            $nickname= escapeshellarg($_POST[nickname]);
            $rank = escapeshellarg($_POST[rank]);

            $command = 'python3 view_teams.py';

            // remove dangerous characters from command to protect web server
            $escaped_command = escapeshellcmd($command);
            //echo "<p>command: $command <p>"; 
            // run view_teams.py
            system($escaped_command);
        }
        ?>

        <form action="http://www.csce.uark.edu/~zachapma/project_python/home.html">
            <input type="submit" value="Return to Home Page" />
        </form>

    </body>
</html>