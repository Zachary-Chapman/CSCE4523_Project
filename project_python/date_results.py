import sys
import traceback
import logging
import python_db 

mysql_username = 'rjnadwod'
mysql_password = 'eic0ahSh'

try:
    python_db.open_database('localhost', mysql_username, mysql_password, mysql_username)
    print("Open Database")
    date = sys.argv[1]
    query = """SELECT g.Date, g.location, t.TeamName AS 'Home', t.Nickname, T.TeamName AS 'Away', T.Nickname, 
            r.ScoreOne AS 'Home Score', r.ScoreTwo AS 'Away Score', r.Winner FROM RESULT r 
            LEFT JOIN GAME g ON r.GameID = g.GameID LEFT JOIN TEAM t ON r.TeamOneID = t.TeamID
            LEFT JOIN TEAM T ON r.TeamTwoID = T.TeamID WHERE Date = '""" + date + "';"
    result = python_db.executeSelect(query)
    result = result.split('\n')
    print("<br/>" + "Games played on that day" + result[0] + "<br/>" + result[1])
    for i in range(len(result)):
        print(result[i])
    python_db.close_db()
    
except Exception as e:
    print("Error!")
    logging.error(traceback.format_exc())