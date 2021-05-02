# Installs requirements
apt-get update
apt-get -y install < requirements.txt 

# Can be git clone once the repository is public
git clone https://github.com/EDataScriptware/SeniorProjectDevelopment.git

# Rewrites apache2.conf file and restarts the apache2 service.
cp deployment/apache2.conf /etc/apache2/apache2.conf
service apache2 restart

# Creates directories.
mkdir ../upload
mkdir ../incident_report

# Notice of Completion
echo "deployment.sh execution complete!"