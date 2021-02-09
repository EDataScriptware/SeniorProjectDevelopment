```# Senior Project Development - Rochester Honor Flight
## The Raspberry Pi 3 Server Requirement Specifications

**Linux OS:** Raspbian 8

**URL:** http://129.21.148.6/ 

**Username:** pi

**Password:** raspberry

**Localhost:** raspberrypi

**PHP Version**: 7.3.19-1~deb10u1

**MySQL Version:** Ver 14.14 Debian-Linux-GNU

**MySQL Username:** root@localhost

**MySQL Password:** student

**Python Version:** Python 3.6.3


## Updating the Raspberry Pi 3 Server
"Every minute updates the Raspberry Pi 3."
Current Process: 
1. Cron will be triggered and create a process what is called a "cronjob."
2. The cronjob will initiate bash tasks in the script. 
3. Bash task will pull the recent changes from the master branch to the Raspberry Pi 3 database. 
