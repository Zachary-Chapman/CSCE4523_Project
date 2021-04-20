import sys
import traceback
import logging
import python_db


mysql_username = 'rjnadwod' # please change to your username
mysql_password= 'eic0ahSh'  # please change to your MySQL password

try:
    python_db.open_database('localhost',mysql_username,mysql_password,mysql_username) # open database
    res =python_db.executeSelect('SELECT * FROM TEAM;')
    res=res.split('\n')# split the header and data for printing
    print("<br/>"+ "All Teams:"+res[0]+ "<br/>"+res[1])
    for i in range(len(res)-2):
        print(res[i+2])
    python_db.close_db() # close db    
except Exception as e:
        logging.error(traceback.format_exc())