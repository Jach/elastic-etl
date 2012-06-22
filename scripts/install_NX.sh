#!/bin/sh
echo "-----------Downloading packages---------------"
#wget http://64.34.161.181/download/3.5.0/Linux/nxclient_3.5.0-7_i386.deb
#wget http://64.34.161.181/download/3.5.0/Linux/nxnode_3.5.0-6_i386.deb
#wget http://64.34.161.181/download/3.5.0/Linux/FE/nxserver_3.5.0-8_i386.deb
wget http://64.34.161.181/download/3.5.0/Linux/nxclient_3.5.0-7_amd64.deb
wget http://64.34.161.181/download/3.5.0/Linux/nxnode_3.5.0-6_amd64.deb
wget http://64.34.161.181/download/3.5.0/Linux/FE/nxserver_3.5.0-8_amd64.deb

echo "-------------Installing client----------------"
#dpkg -i nxclient_3.5.0-7_i386.deb
dpkg -i nxclient_3.5.0-7_amd64.deb
echo "---------------Installing node----------------"
#dpkg -i nxnode_3.5.0-6_i386.deb
dpkg -i nxnode_3.5.0-6_amd64.deb
echo "-------------Installing server----------------"
#dpkg -i nxserver_3.5.0-8_i386.deb
dpkg -i nxserver_3.5.0-8_amd64.deb

echo "------------Stop NX server--------------------"
/usr/NX/bin/nxserver --stop

echo "-------------Copy Configuration---------------"
cp  /usr/NX/etc/server.cfg /usr/NX/etc/server.cfg.bak
cp  ./server.cfg /usr/NX/etc/server.cfg

echo "-----------Start NX server--------------------"
/usr/NX/bin/nxserver --start

echo "-------------Add root-------------------------"
/usr/NX/bin/nxserver --useradd root
/usr/NX/bin/nxserver --userenable root

echo "-----------Change Password for root-----------"
echo "root:123qweasd" | chpasswd

echo "-----------Install Spoon Script---------------"
cp ./spoon /usr/bin/spoon
chmod 755 /usr/bin/spoon

echo "----------Copying private key-----------------"
cp /usr/NX/share/keys/server.id_dsa.key /opt/elastic/elasticfolder/NX\ key/server.id_dsa.key
