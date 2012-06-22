if [ ! -e /usr/local/bin/nephoscale-admin ]; then
  echo "ERROR: nephoscale-admin does not exist!"
fi
/usr/local/bin/nephoscale-admin install -v cloudfuse > /tmp/cloudfuse.log
cat <<EOF>>/root/.cloudfuse
username=youruser:yourport
api_key=yourapikey
use_snet=False
authurl=https://api.nephoscale.com/storage/auth/
EOF
mkdir /opt/elastic-etl
/usr/local/bin/cloudfuse /opt/elastic-etl
