import sys
import traceback
import logging
import python_db 

mysql_username = 'rjnadwod'
mysql_password = 'eic0ahSh'

try:
    python_db.open_database('localhost', mysql_username, mysql_password, mysql_username)
    teamName = sys.argv[1]
    query = """SELECT t1.TeamName AS 'Team Name', t1.Nickname, r.GameID, r.ScoreOne AS 'Team Score', 
            r.ScoreTwo AS 'Opponents Score', t2.TeamName AS 'Opponets Name', g.date, r.Winner FROM RESULT r 
            LEFT JOIN TEAM t1 ON r.TeamOneID = t1.TeamID LEFT JOIN TEAM t2 ON r.TeamTwoID = t2.TeamID 
            LEFT JOIN GAME g on r.GameID = g.GameID WHERE t1.TeamName = '""" + teamName + """' UNION 
            SELECT t2.TeamName AS 'Team Name', t2.Nickname, r.GameID, r.ScoreOne AS 'Team Score', 
            r.ScoreTwo AS 'Opponents Score', t1.TeamName AS 'Opponets Name', g.date, r.Winner FROM RESULT r 
            LEFT JOIN TEAM t1 ON r.TeamOneID = t1.TeamID LEFT JOIN TEAM t2 ON r.TeamTwoID = t2.TeamID 
            LEFT JOIN GAME g on r.GameID = g.GameID WHERE t2.TeamName = '""" + teamName + "';" 
    results = python_db.executeSelect(query)
    results = results.split('\n')
    print("<br/>" + "Games that team played in" + results[0] + "<br/>" + results[1])
    for i in range(len(results)):
        print(results[i])
    python_db.close_db()
except Exception as e:
    logging.error(traceback.format_exc())