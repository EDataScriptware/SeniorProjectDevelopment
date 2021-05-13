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
print("SSH tunnel is open.")
local_port = str(tunnel.local_bind_port)
print(local_port)

conn = pymysql.connect(host='127.0.0.1', user=username, passwd=password, port=tunnel.local_bind_port, database="honor_flight") 

def getVeteranNames(missionIdentfier):
    data = pd.read_sql_query("SELECT first_name, middle_initial, last_name, team_id FROM veteran WHERE mission_id = " +  missionIdentfier  + " ORDER BY team_id, last_name  ;", conn)
    return data.to_numpy()

def getAllVeteran(missionIdentfier):
    data = pd.read_sql_query("SELECT * FROM veteran WHERE mission_id = " +  missionIdentfier  +  " ORDER BY team_id, last_name;", conn)
    return data.to_numpy()

def matchGuardianAndVet(guardianId):
    data = pd.read_sql_query("SELECT guardian.first_name, guardian.middle_initial, guardian.last_name, guardian.address, guardian.city, guardian.state, guardian.zip, guardian.nickname, guardian.day_phone, guardian.cell_phone from veteran JOIN guardian ON veteran.guardian_id = guardian.guardian_id WHERE guardian.guardian_id = " + str(guardianId), conn)
    return data.to_numpy()

def getSpecificVeteran(veteran_id):
    data = pd.read_sql("SELECT * FROM veteran WHERE veteran_id = " + str(veteran_id), conn)
    return data.to_numpy()

def matchSpecificGuardianAndVet(guardian_Id):
    data = pd.read_sql_query("SELECT guardian.first_name, guardian.middle_initial, guardian.last_name, guardian.address, guardian.city, guardian.state, guardian.zip, guardian.nickname, guardian.day_phone, guardian.cell_phone from veteran JOIN guardian ON veteran.guardian_id = guardian.guardian_id WHERE guardian.guardian_id = " + str(guardian_Id), conn)
    return data.to_numpy()
