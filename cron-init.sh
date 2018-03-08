#!/bin/bash
croncmd="php $(pwd)/cronjob.php"
cronjob="0 */15 * * * $croncmd"
echo $croncmd
if [ "$1" == "--remove" ]
then
  echo "removing"
else
  echo "adding cronjob"
fi
