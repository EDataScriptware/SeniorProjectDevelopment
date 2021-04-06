# Deployment Plan
## Standalone File deployment.sh && CREATE_honorflight.sql
### AUTHORED: Edward Riley

- Open up your terminal and head inside the SeniorProjectDevelopment directory. Type in the following commands below. These commands will help you to be set and ready for deployment with these base files below.
```
sudo bash deployment/deployment.sh 
```

- This CREATE_honorflight.sql will help you to be set with database tables for the project.  
```
mysql -u insert_username -p < CREATE_honorflight.sql
```

When the script is completed, you will receive a message `deployment.sh execution complete!`