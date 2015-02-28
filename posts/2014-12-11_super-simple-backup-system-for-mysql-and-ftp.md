title->Super Simple Backup System for Mysql and Ftp
author->Matteo Merola
tags->nerd, backup, mysql, KISS
image->/public/content/backupsystem.jpg
---:endmetadata:---

## __A 'KeepItSuperSimple' backup system for mysql and ftp__

Hi all, I would like to share with you some script I use to backup my websites. These scripts are in bash and perform the backup of mysql and ftp within a cronjob.

First you need to create a folder for your scripts
`mkdir /home/matt/scripts`

Then you need to create a folder for each website you want to backup (_imagine you want to backup mysite.com_)
`mkdir /home/matt/scripts/mysite.com`

Now create the folders that will contain your backups as follow:
`cd /home/matt/scripts/mysite.com && mkdir mysql ftp temp`

###### _temp folder is needed by the system in order to backup correctly_

Now you can create a file named `mysqlbackup.sh` and a file named `ftpbackup.sh` as follows

<script src="https://gist.github.com/mattmezza/d2b868ce51030c9b908b.js"></script>

#### You have to edit these files by providing the valid credentials to connect to mysql and ftp properly.

##### You can also edit these two files to change the retention of the backup files. Standard is 15  tar archives (one per day) for mysql and 2 archives (one per week) for ftp.

Make these file executable by entering this `chmod +x /home/matt/scripts/ftpbackup.sh` and `chmod +x /home/matt/scripts/mysqlbackup.sh`.

Now whenever you execute `./mysqlbackup.sh mysite.com` or `./ftpbackup.sh mysite.com` the system starts backing up your website.

You can automate this procedure by creating a cronjob.

Enter `sudo crontab -e` to access the cronjob tab.

Now edit the file inserting (at the end of the file) this row:

`01 19 * * *     cd /home/matt/scripts && ./mysqlbackup.sh mysite.com`

###### _it says: "backup mysql every day at 7:01 pm"_

For ftp insert another row:
`01 20 * * 0     cd /home/matt/scripts && ./ftpbackup.sh mysite.com`

###### _it says: "backup ftp every week, on sunday at 8:01 pm"_

It should work (I hope so 😝) but I'm opened to whom would like to criticize my work in order to achieve the best and simplest backup system for mysql and/or ftp.
