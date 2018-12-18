#!/bin/bash

ip='192.168.1.6'

grn=$'\e[1;32m'
red=$'\e[1;31m'

echo "[Monitoring $ip for availability]"

while true; do
	
	if ping -c 1 $ip &> /dev/null
	then
		echo "${grn}Host Found at [$ip] | No Changes Made!"
		sleep 2 
	else
		echo "${red}Host Not Found at [$ip] | HotSwap has been executed!"
		php changehotswapIP.php
		break
	fi
done
