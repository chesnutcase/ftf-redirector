#!/bin/bash
#still doesn't work - you'll have to manually add the cronjob yourself
#if you can point out what's wrong, please tell me!
croncmd="php $(pwd)/cronjob.php > $(pwd)/cronlog.txt"
cronjob="*/15 * * * * $croncmd"
echo $croncmd
if [ "$1" == "--remove" ]
then
  echo "removing cronjob";
  echo $(crontab -l | grep -v $croncmd) | crontab -
else
  echo "adding cronjob"
  if [[ $(crontab -l | egrep -v "^(#|$)" | egrep -v "^no crontab for" | grep -q $croncmd; echo $?) == 1 ]]
  then
    echo $(crontab -l | egrep -v "^no crontab for" ; echo $croncmd) | crontab -
  fi
fi
