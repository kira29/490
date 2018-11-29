#!bin/bash

# SCP the tar that was just made to the deploy server
scp /home/parth/backups/* parth@192.168.1.186:/var/temp

#delete local copy once tar has reached server
rm -r /home/parth/backups/*

