import sys
import traceback
import logging
import python_db


mysql_username = 'rjnadwod' # please change to your username
mysql_password= 'eic0ahSh'  # please change to your MySQL password

try:
    python_db.open_database('localhost',mysql_username,mysql_password,mysql_username) # open database
    res =python_db.executeSelect('SELECT * FROM GAME;')
    res=res.split('\n')# split the header and data for printing
    print("<br/>"+ "Table TEAM before:"+res[0]+ "<br/>"+res[1])
    for i in range(len(res)-2):
        print(res[i+2])
    teamone = sys.argv[1]
    teamtwo = sys.argv[2]
    location = sys.argv[3]
    date = sys.argv[4]
    val = "NULL" + ", " + teamone + ", " + teamtwo + ", '" + location + "','" + date + "'"
    python_db.insert("GAME",val)
    res = python_db.executeSelect('SELECT * FROM GAME;')
    res=res.split('\n')# split the header and data for printing
    print("<br/>" + "<br/>")
    print("<br/>"+ "Table GAME after:"+res[0]+ "<br/>"+res[1])
    for i in range(len(res)-2):
        print(res[i+2])
    python_db.close_db() # close db    
except Exception as e:
        logging.error(traceback.format_exc())