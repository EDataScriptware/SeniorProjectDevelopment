# Deployment Plan
## Standalone File deployment.sh && CREATE_honorflight.sql
### AUTHORED: Edward Riley
### EDITOR: Zach Easley

- The following commands must be run on a Debian-distribution Linux Terminal inside the unzipped folder "deployment". These commands will help you get set and ready for deployment with these base files below.
```
    sudo bash deployment.sh 
```

When the script is completed, you will receive a message `deployment.sh execution complete!` It will perform the following actions:
- Installs requirements
- Installs the python3 pip3 packages.
- Rewrites apache2.conf file and restarts the apache2 service.
- Creates two directories.

- This CREATE_honorflight.sql set you up the database structure and keys for the project. Chose the method below that works best for your system and run the command:
METHOD #1 (Running the script without logging in):
```
    mysql -p -u root < CREATE_honorflight.sql
```

METHOD #2 (Logging in and then running the script):
```
    mysql -p -u root
    source CREATE_honorflight.sql
```

- Inside the project dicretory, make changes to /application/config/database.php scroll down to the bottom where the database connection credentials are stored.  And update the information regarding your current device and authentication.  

- Values you are interested in are:
```
    ...
    'hostname' => 'localhost',    # The IP address or hostname where the database is stored - it is localhost by default
	'username' => 'pi',           # The authentication username that the application will login to the database with.
	'password' => 'raspberry',    # The authentication password that the application will utilize to log into the database (in correspondence to the 'username')
	'database' => 'honor_flight', # This value shouldn't need adjusting (assuming the database was built correctly in the steps above)
    ...
```