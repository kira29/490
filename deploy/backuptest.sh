#!/bin/bash

# What to backup. 
backup_files="/home/parth/git"

# Where to backup to.
dest="/home/parth/backups"
#noooo
# version_num= $1
# version_n=$1

# Create archive filename.
current_time=$(date +%m-%d-%Y_%H-%M-%S)
archive_file="bundle-$current_time.tgz"

# Print start status message.
echo "Backing up $backup_files to $dest/$archive_file"
date
echo

# Backup the files using tar.
tar czf $dest/$archive_file --absolute-names $backup_files

# Print end status message.
echo
echo "Backup finished"
date
echo

# SCP the tar that was just made to the deploy server 
scp /home/parth/backups/* parth@192.168.1.186:/var/temp

#delete local copy once tar has reached server
rm -r /home/parth/backups/*

# Long listing of files in $dest to check file sizes.
#ls -lh $dest
