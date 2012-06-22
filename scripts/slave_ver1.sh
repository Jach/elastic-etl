echo "Slave starting running slave_ver1.sh" > /tmp/slave_setup_log

echo "Rewriting apt sources and updating" >> /tmp/slave_setup_log

cat > /etc/apt/sources.list <<EOF
# ubuntu packages
deb http://mirrors.nephoscale.com/ubuntu/ lucid main
deb http://mirrors.nephoscale.com/ubuntu/ lucid-updates main
 
deb http://mirrors.nephoscale.com/ubuntu/ lucid restricted
deb http://mirrors.nephoscale.com/ubuntu/ lucid-updates restricted
 
deb http://mirrors.nephoscale.com/ubuntu/ lucid universe
deb http://mirrors.nephoscale.com/ubuntu/ lucid-updates universe
 
deb http://mirrors.nephoscale.com/ubuntu/ lucid multiverse
deb http://mirrors.nephoscale.com/ubuntu/ lucid-updates multiverse
 
# security updates
deb http://mirrors.nephoscale.com/ubuntu lucid-security main restricted
deb http://mirrors.nephoscale.com/ubuntu lucid-security universe
deb http://mirrors.nephoscale.com/ubuntu lucid-security multiverse

# partner
deb http://mirrors.nephoscale.com/ubuntu-partner/ lucid partner
EOF

apt-get update >> /tmp/slave_setup_log

# install subversion
apt-get -y install subversion

mkdir -p /opt/elastic
cd /opt/elastic

echo "Starting to pull SVN" >> /tmp/slave_setup_log

#find /root -type f >> /tmp/slave_setup_log

# Pull git (used to be svn)
# The rest of the bootstrap pieces are contained in the SVN directory
# Easier to manage in a single place

# Needed to create .subversion directory
#svn help
# Allow for no prompting of credentials
#echo "store-plaintext-passwords = yes" >> /root/.subversion/servers

# cat /root/.subversion/servers >> /tmp/slave_setup_log

# Grab the SVN repository
git clone git://github.com/dynamobi/elastic-etl.git

cd /opt/elastic/elastic-etl/scripts
chmod +x ./install_NX.sh
./install_NX.sh
chmod +x ./do_slave_bootstrap.sh
./do_slave_bootstrap.sh
