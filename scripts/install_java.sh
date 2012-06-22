cat <<EOF>>/root/.bashrc
export JAVA_HOME=/usr/lib/jvm/java-6-sun
export PATH=$PATH:$JAVA_HOME/bin:/opt/kettle
EOF

# install unzip
apt-get -y install unzip
apt-get -y install zip

# ensure java is installed
apt-get -y install java-common
apt-get -y install python-software-properties

# pre-accept Sun Java license terms
echo "sun-java6-bin shared/accepted-sun-dlj-v1-1 boolean true" | debconf-set-selections

# install java
apt-get -y install sun-java6-bin sun-java6-jre sun-java6-jdk sun-java6-plugin sun-java6-fonts ant

update-alternatives --config java

