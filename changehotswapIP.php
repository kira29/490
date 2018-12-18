#!/usr/bin/php
<?php
## Implement wildcards to ip later...
#/home/roydem/database/deployment/deployclientrabbitMQServer.ini
#string to replace
$oldip = '192.168.1.6';
#new string
$newip = '192.168.1.10';
#-------Change IP in .ini file ---------------
#Read file
$str = file_get_contents('deploy/deployclientrabbitMQServer.ini');
#Replace
$str = str_replace($oldip,$newip,$str);
#Write
file_put_contents('deploy/deployclientrabbitMQServer.ini', $str);
#------- Change IP in BundleClient (Demo with deploy server) ------------
#Read file
$str2 = file_get_contents('deploy/scp_tar.sh');
#Replace
$str2 = str_replace($oldip,$newip,$str2);
#Write
file_put_contents('deploy/scp_tar.sh', $str2);
?>
