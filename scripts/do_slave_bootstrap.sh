# OBSOLETE
# Once used for NephoScale before moving to Amazon.
lg='/tmp/slave_setup_log'
echo "Starting slave bootstrap" >> $lg 2>&1

echo "Running Java install" >> $lg 2>&1
. ./install_java.sh >> $lg 2>&1

echo "Installing cloudfuse and mounting to /elastic" >> $lg 2>&1
. ./setup_cloudfuse.sh

export PRIVATE_IP=`ifconfig | egrep 'inet addr:10\.' | cut -f2 -d':' | cut -f1 -d' '`
echo "Determined PRIVATE_IP to be ${PRIVATE_IP}" >> $lg 2>&1
export SLAVE_ID=`hostname`
echo "Determined SLAVE_ID to be ${SLAVE_ID}" >> $lg 2>&1

echo "Running readline install" >> $lg 2>&1
apt-get -y install libreadline6-dev >> $lg 2>&1

echo "Running Ruby and Bundler gem install" >> $lg 2>&1
apt-get -y install ruby-full rubygems1.8 >> $lg 2>&1
# Need to update rubygems to >= 1.3.6
gem install rubygems-update
/var/lib/gems/1.8/bin/update_rubygems
gem install bundler >> $lg 2>&1

echo "Running git install" >> $lg 2>&1
apt-get -y install git-core >> $lg 2>&1

loc=`pwd`
echo "Running GoodData install" >> $lg 2>&1
. ./install_gooddata.sh >> $lg 2>&1
cd $loc

echo "Running Kettle install" >> $lg 2>&1
. ./install_kettle.sh  >> $lg 2>&1

echo "Sourcing .bashrc to get java" >> $lg 2>&1
source /root/.bashrc

#echo "Running NX server install" >> $lg 2>&1
#chmod +x ./install_NX.sh >> $lg 2>&1
#. ./install_NX.sh >> $lg 2>&1

# Startup Carte server
# with max memory minus 1 GB, or minus 50MB if machine has less than a gig
mem=`free -m | head -n 2 | tail -n 1 | awk '{print ($2-1024 > 0) ? $2 - 1024 : $2 - 50}'`
export PENTAHO_DI_JAVA_OPTIONS="-Xmx"$mem"m"
cd /opt/elastic/kettle/data-integration
./carte.sh ${PRIVATE_IP} 8080 > /tmp/carte_log &

# Starting polling job 
cd /opt/elastic/elastic-etl/scripts
crontab crontab
