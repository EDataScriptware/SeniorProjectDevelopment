# Deployment Plan
## Standalone File deployment.sh && CREATE_honorflight.sql
In your terminal inside the SeniorProjectDevelopment directory. 
```
sudo bash deployment/deployment.sh 
mysql -u insert_username -p < CREATE_honorflight.sql
```

When the script is completed, you will receive a message `deployment.sh execution complete!`