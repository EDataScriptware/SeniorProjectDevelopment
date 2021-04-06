```# Senior Project Development - Rochester Honor Flight
## The Raspberry Pi 3 Server Requirement Specifications

**Linux OS:** Raspbian 10 (Buster)

**IP Address:** 129.21.148.57

**Hostname:** http://rwby.student.rit.edu/

**Username:** pi

**Password:** [REDACTED] - SECURITY REASONS

**Localhost:** raspberrypi

**PHP Version**: 7.3.19-1~deb10u1

**MySQL/MariaDB Version:** Ver 15.1

**MySQL/MariaDB Username:** pi@localhost

**MySQL/MariaDB Password:** raspberry

**Python Version:** Python 3.7.3


## Updating the Raspberry Pi 3 Server
"Every minute updates the Raspberry Pi 3."
Current Process: 
1. Cron will be triggered and create a process what is called a "cronjob."
2. The cronjob will initiate bash tasks in the script. 
3. Bash task will pull the recent changes from the master branch to the Raspberry Pi 3 database.

