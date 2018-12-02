#!/bin/bash

#scp the rollback package to destination


cd /var/temp

# $1 is filename

#delete contents first
ssh parth@192.168.1.186 'rm -rf /home/parth/Desktop/Parth/*'


#send new rollback version
pv $1 | ssh parth@192.168.1.8 'cat | tar xz -C /home/parth/Desktop/Parth'


#pv testpackage-2.tgz | ssh parth@192.168.1.8 'cat | tar xz -C /home/parth/Desktop/Parth'

