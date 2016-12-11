import sqlite3

#connection=sqlite3.connect(':memory:')
connection = sqlite3.connect('login.db')
cursor=connection.cursor()


cursor.execute('CREATE TABLE login (Username VARCHAR(20) UNIQUE, Email VARCHAR(20), Password VARCHAR(20))')

connection.commit()
connection.close()

print "Connection closed"