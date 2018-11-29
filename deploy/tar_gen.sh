#!/bin/bash

# What to backup.
backup_files="/home/parth/git"

# Where to backup to.
dest="/home/parth/backups"



# version_num= $1
# version_n=$1

# Create archive filename.
current_time=$(date +%m-%d-%Y_%H-%M-%S)
archive_file="backup.tgz"

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


# Long listing of files in $dest to check file sizes.
ls -lh $dest





