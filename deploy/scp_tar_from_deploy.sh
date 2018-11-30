#!/bin/bash

# SCP the tar from the deploy server to its destination

sourcefile=$1

#scp /var/temp/$sourcefile parth@192.168.1.186:/home/parth/Desktop/Parth

cd /var/temp

#pv $sourcefile | ssh parth@192.168.1.8 'cat | tar xz -C /home/parth/Desktop/Parth'


pv testpackage-2.tgz | ssh parth@192.168.1.8 'cat | tar xz -C /home/parth/Desktop/Parth'
