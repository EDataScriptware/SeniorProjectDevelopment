# Senior Project Development - Rochester Honor Flight
## The Raspberry Pi 4 Server Requirement Specifications

**Linux OS Distribution Family:** Debian-based

**Linux OS:** Raspbian 10 (Buster)

**Localhost:** 127.0.0.1

**PHP Version**: 7.3.19-1~deb10u1

**MySQL/MariaDB Version:** Ver 15.1

**MySQL/MariaDB Username:** pi@localhost

**MySQL/MariaDB Password:** raspberry

**Python Version:** Python 3.7.3

## Updating the Raspberry Pi 4 Server (Exclusive to Team Ruby)
What is a Cron? Cron is a scheduler on all Linux OS that allows the devies to trigger at a certain DateTime. 
- [For more information about Cron, please search here.](https://www.pair.com/support/kb/configuring-cron/) 
- [For more information about how scheduler crontab, please search here.](https://crontab.guru/)

Consistent Data Current Process: 
1. Cron will be triggered and create a process what is called a "cronjob."
2. The cronjob will initiate bash tasks in the script. 
3. Bash task will pull the recent changes from the master branch to the Raspberry Pi 4 database.

## Deployment Plan
### Standalone File deployment.sh && CREATE_honorflight.sql
In your terminal inside the SeniorProjectDevelopment directory. 
```
sudo bash deployment/deployment.sh 
mysql -u insert_username -p < CREATE_honorflight.sql
```

When the script is completed, you will receive a message `deployment.sh execution complete!`