import sys
import traceback
import logging
import python_db


mysql_username = 'rjnadwod' # please change to your username
mysql_password= 'eic0ahSh'  # please change to your MySQL password

try:
    python_db.open_database('localhost',mysql_username,mysql_password,mysql_username) # open database
    result = python_db.executeSelect("SELECT * FROM RESULT;")
    result = result.split('\n')
    print("<br/>" + "Table RESULT before: " + result[0] + "<br/>" + result[1])
    for i in range(len(result)):
        print(result[i])
    gameID = sys.argv[1]
    teamOne = sys.argv[2]
    teamTwo = sys.argv[3]
    teamOneScore = sys.argv[4]
    teamTwoScore = sys.argv[5]
    winner = sys.argv[6]
    val = gameID + ", " + teamOne + ", " + teamTwo + ", " + teamOneScore + ", " + teamTwoScore + ", '" + winner + "'"
    python_db.insert("RESULT", val)
    result = python_db.executeSelect("SELECT * FROM RESULT;")
    result = result.split('\n')
    print("<br/>" + "Table RESULT After: " + result[0] + "<br/>" + result[1])
    for i in range(len(result)):
        print(result[i])
    python_db.close_db()

except Exception as e:
    logging.error(traceback.format_exc())
