cd /opt/elastic
mkdir kettle
cd kettle
tar -xzf /opt/elastic/elasticfolder/bin/pdi-ce-4.1.0-stable.tar.gz

#create kettle.properties
mkdir /root/.kettle
cp /opt/elastic/elastic-etl/elastic/bin/.kettle/kettle.properties /root/.kettle/kettle.properties

# Add PRIVATE_IP to kettle.properties
cat <<EOF>>/root/.kettle/kettle.properties
private.ip=${PRIVATE_IP}
slave.id=${SLAVE_ID}
EOF
