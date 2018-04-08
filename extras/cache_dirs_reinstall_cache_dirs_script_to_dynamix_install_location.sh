if [ "$USER" != "root" ]
then
  echo "ERROR: Run as root"
  exit 1
fi  

SCRIPT=/boot/config/plugins/dynamix.cache.dirs/cache_dirs 
RC=/usr/local/emhttp/plugins/dynamix.cache.dirs/scripts/rc.cachedirs
#cp /boot/config/plugins/cache_dirs.plg /tmp/plugins/
#plugin update cache_dirs.plg

# also use online http://www.shellcheck.net/ to check for problems
# compile syntax checking
bash -n $SCRIPT
if [ "$?" -ne "0" ] ; then 
	echo "Syntax error in script"
	exit 1
fi
echo "Stopping"
$RC stop

ps -e x -o pid -o ppid -o pgid -o tty -o vsz -o rss -o etime -o cputime -o rgroup -o ni -o fname -o args | /boot/bin/grep1 cache_dirs
ps -e x -o pid -o ppid -o pgid -o tty -o vsz -o rss -o etime -o cputime -o rgroup -o ni -o fname -o args | /boot/bin/grep1 timeout

cache_dirs_cp
cp $SCRIPT /usr/local/emhttp/plugins/dynamix.cache.dirs/scripts
cp rc.cachedirs /usr/local/emhttp/plugins/dynamix.cache.dirs/scripts

# /etc/rc.d/rc.cache_dirs startForeground
echo "Starting"
$RC start
sleep 1
tail -f -n 100 /var/log/cache_dirs.log 

# current command
# sudo /usr/local/emhttp/plugins/dynamix.cache.dirs/scripts/cache_dirs -e app -e appbackup -e docker -e windowsbackup -i media -i sync
# sudo cache_dirs -e app -e appbackup -e docker -e windowsbackup -i media -i sync
# Foreground
# sudo cache_dirs -e app -e appbackup -e docker -e windowsbackup -i media -i sync -Fv
