<html>
    <body>
        <h3>Results by Date:</h3>
        <h3> Please chose a date. </h3>

        <form action="date_results.php" method="post" style="margin-bottom: 10px">
            date: <input type="date" name="date" style="margin-bottom: 10px"><br>
            <input name="submit" type="submit" style="margin-bottom: 20px">
        </form>

        <br><br>

        <form action="http://www.csce.uark.edu/~rjnadwod/project_python/home.html">
            <input type="submit" value="Return to Home Page" />
        </form>

    </body>
</html>

<?php
if(isset($_POST['submit']))
{
    $date = escapeshellarg($_POST[date]);
    $command = 'python3 date_results.py' . ' ' . $date;
    
    $escaped_command = escapeshellcmd($command);
    echo "<p>command: $command <p>";
    system($escaped_command);
}
?>
