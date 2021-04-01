from sshtunnel import SSHTunnelForwarder
import sqlalchemy as sql
from sqlalchemy.orm import sessionmaker
import mysql.connector
import pymysql
import pandas as pd

username = "pi"
password = "raspberry"
hostname = "localhost"
ipAddress = "129.21.148.57"
database = "honor_flight"

tunnel = SSHTunnelForwarder(
('129.21.148.57', 22), ssh_username = "pi",
ssh_password = "Edward", remote_bind_address=('127.0.0.1', 3306))
tunnel.start()
#print("SSH tunnel is open.")
local_port = str(tunnel.local_bind_port)
#print(local_port)

conn = pymysql.connect(host='127.0.0.1', user=username, passwd=password, port=tunnel.local_bind_port, database="honor_flight") 


def getVeteranNames():
    data = pd.read_sql_query("SELECT first_name, middle_initial, last_name FROM veteran;", conn)
    return data.to_numpy()
