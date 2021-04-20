import mysql.connector
from tabulate import tabulate

#Function to open the database for use
def openDatabase(hostname, username, myPassword, databaseName):
      global conn
      conn = mysql.connector.connect( host = hostname, user = username, password = myPassword, database = databaseName)
      global cursor
      cursor = conn.cursor()
      
#Function to print results in a neat manner
def printFormat(result):
      header = []
      for cd in cursor.description: #get the headers
            header.append(cd[0])
      print('')
      print('Query Results')
      print('')
      print(tabulate(result, headers = header)) #prints the results in a table format

#Function to preform a select and display the query
def executeSelect(query):
      cursor.execute(query)
      printFormat(cursor.fetchall())
      
#Function to preform a insert query
def insert(table, values):
      query = "INSERT INTO " + table + " VALUES (" + values + ")" +';'
      cursor.execute(query)
      conn.commit()

#Function to preform a update or delete query
def executeUpdate(query):
      cursor.execute(query)
      conn.commit()
      
#Function to close the database
def closeDatabase():
      cursor.close()
      conn.close()

#Function to get data from the database in a useable manner
def getData(query):
      cursor.execute(query)
      result = cursor.fetchall()
      return result

#Function to get the next supplier ID
def getID(ID, tableName):
      query_pt1 = "SELECT " + ID + " FROM " + tableName
      query_pt2 = "ORDER BY " + ID + " DESC "
      query_pt3 = "LIMIT 1;"
      query = query_pt1 + query_pt2 + query_pt3
      cursor.execute(query)
      result = cursor.fetchall()
      return result[0][0]
      
#my mysql username and password
username = 'zachapma' 
myPassword ='Eeja3dae'

openDatabase('localhost', username, myPassword, username) #open my database
i = 0
while i != 7:
      
    #Simple UI to understand what the user wants
    print("[1] Add a team")
    print("[2] Add a Game")
    print("[3] Add the Results to a game")
    print("[4] View all teams")
    print("[5] View all results for a team")
    print("[6] View all results for a date")
    print("[7] Quit")
    i = int(input())

    if i == 1:
        table = "TEAM"
        teamID = getID("TeamID", table) + 1
        name = input("Enter the name of the team: ")
        nickname = input("Enter the nickname of the team: ")
        rank = int(input("Enter the rank of the team: "))
        teamValue = str(teamID) + ", '" + name + "', '" + nickname + "', " + str(rank)
        insert(table, teamValue) 
        query = "SELECT * FROM TEAM;"
        executeSelect(query)

    if i == 2:
        table = "GAME"
        gameID = getID("GameID", table) + 1
        rank1 = int(input("Enter the rank of the first team (Please make sure the team is already in the database): "))
        rank2 = int(input("Enter the rank of the second team (Please make sure the team is already in the database): "))
        location = input("Enter the court where the game took place: ")
        date = input("Enter the date of the game (EX: YYYY-MM-DD): ")
        gameValue = str(gameID) + ", " + str(rank1) + ", " + str(rank2) + ", '" + location + "', '" + date + "'"
        insert(table, gameValue)
        query = "SELECT * FROM GAME;"
        executeSelect(query)

    if i == 3:
        table = "RESULT"
        gameID = int(input("Enter the ID of the game (Please make sure that the game is in the database first and doesnt already have its results stored): "))
        team1_ID = int(input("Enter the ID of the first team (Please make sure the team is in the database): "))
        team2_ID = int(input("Enter the ID of the second team (Please make sure the team is in the database): "))
        score1 = int(input("Enter the score that the first team got at the end of the game: "))
        score2 = int(input("Enter the socre that the second team got at the end of the game: "))
        winner = input("Enter the team name of the winner: ")
        resultValue = str(gameID) + ", " + str(team1_ID) + ", " + str(team2_ID) + ", " + str(score1) + ", " + str(score2) + ", '" + winner + "'"
        insert(table, resultValue)
        query = "SELECT * FROM RESULT;"
        executeSelect(query) 

    if i == 4:
        query = "SELECT * FROM TEAM;"
        result = getData(query)
        printFormat(result)

    if i == 5:
        teamName = input("Enter the name of the team you would like see the results for: ")
        query_pt1 = "SELECT t1.TeamName AS 'Team Name', t1.Nickname, r.GameID, r.ScoreOne AS 'Team Score', "
        query_pt2 = "r.ScoreTwo AS 'Opponents Score', t2.TeamName AS 'Opponets Name', g.date, r.Winner FROM RESULT r "
        query_pt3 = "LEFT JOIN TEAM t1 ON r.TeamOneID = t1.TeamID LEFT JOIN TEAM t2 ON r.TeamTwoID = t2.TeamID "
        query_pt4 = "LEFT JOIN GAME g ON r.GameID = g.GameID WHERE t1.TeamName = '" + teamName + "' UNION "
        query_pt5 = "SELECT t2.TeamName AS 'Team Name', t2.Nickname, r.GameID, r.ScoreOne AS 'Team Score', "
        query_pt6 = "r.ScoreTwo AS 'Opponents Score', t1.TeamName AS 'Opponets Name', g.date, r.Winner FROM RESULT r "
        query_pt7 = "LEFT JOIN TEAM t1 ON r.TeamOneID = t1.TeamID LEFT JOIN TEAM t2 ON r.TeamTwoID = t2.TeamID "
        query_pt8 = "LEFT JOIN GAME g ON r.GameID = g.GameID WHERE t2.TeamName = '" + teamName + "';"
        query = query_pt1 + query_pt2 + query_pt3 + query_pt4 + query_pt5 + query_pt6 + query_pt7 + query_pt8
        result = getData(query)
        printFormat(result)

    if i == 6:
          date = input("Enter the date of the day you would like to see the results for (YYYY-MM-DD): ")
          query = """SELECT g.Date, g.Location, t.TeamName AS 'Home', t.Nickname, T.TeamName AS 'Away', T.Nickname, 
                  r.ScoreOne AS 'Home Score', r.ScoreTwo AS 'Away Score', r.Winner FROM RESULT r 
                  LEFT JOIN GAME g ON r.GameID = g.GameID LEFT JOIN TEAM t ON r.TeamOneID = t.TeamID 
                  LEFT JOIN TEAM T ON r.TeamTwoID = T.TeamID WHERE Date = '""" + date + "';"
          print(query)
          result = getData(query)
          printFormat(result)


    if i == 7:
        closeDatabase()
        exit()