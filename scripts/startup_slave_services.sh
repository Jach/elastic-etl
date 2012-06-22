
lg='/tmp/slave_setup_log'
echo "Starting slave bootstrap" >> $lg 2>&1
export PRIVATE_IP=`curl http://169.254.169.254/latest/meta-data/local-ipv4`
echo "Determined PRIVATE_IP to be ${PRIVATE_IP}" >> $lg 2>&1
export SLAVE_ID=`curl http://169.254.169.254/latest/meta-data/instance-id`
echo "Determined SLAVE_ID to be ${SLAVE_ID}" >> $lg 2>&1

lgdir="/opt/elastic/logging/${SLAVE_ID}"
lgsetup="${lgdir}/slave_setup_log"
lgcarte="${lgdir}/carte.log"

echo "LGDIR: ${lgdir}, preparing to moving logging to that dir" >> $lg 2>&1
if [ ! -d "${lgdir}" ]; then
	mkdir ${lgdir}
fi
cp $lg ${lgdir}
echo "Now logging on shared disk" >> $lgsetup 2>&1


# Add PRIVATE_IP to kettle.properties
cat <<EOF>>/home/etlclient/.kettle/kettle.properties
private.ip=${PRIVATE_IP}
slave.id=${SLAVE_ID}
EOF

# Startup Carte server
# with max memory minus 1 GB, or minus 50MB if machine has less than a gig
mem=`free -m | head -n 2 | tail -n 1 | awk '{print ($2-1024 > 0) ? $2 - 1024 : $2 - 50}'`
export PENTAHO_DI_JAVA_OPTIONS="-Xmx"$mem"m"
cd /opt/kettle/data-integration
./carte.sh ${PRIVATE_IP} 8080 >> $lgcarte 2>&1 &

# Starting polling job 
##cd /opt/elastic/elastic-etl/scripts
##crontab crontab

#echo "Running NX server install" >> $lg 2>&1
#chmod +x ./install_NX.sh >> $lg 2>&1
#. ./install_NX.sh >> $lg 2>&1

