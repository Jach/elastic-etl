<?php
echo "Updating BDN last update date\n\r";
mysql_connect("localhost", "logger", "TheeL2Ee") or
    die("Could not connect: " . mysql_error());
mysql_select_db("log");

$result = mysql_query ("UPDATE sf_cxn SET sf_cxn.bdn_last_update = DATE_FORMAT(NOW() ,'%Y-%m-01') WHERE sf_cxn.bdn_flag = 'Y'");

if ($result)
{
    echo "-Done whithout errors\n\r";
}
else
{
    echo "-Done whith some errors\n\r";
}

?>