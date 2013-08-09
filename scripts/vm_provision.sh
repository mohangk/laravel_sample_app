#Use a local mirror if available
MIRROR_STRING='mirrors'
SOURCES_LIST='/etc/apt/sources.list'
if ! grep -q $MIRROR_STRING $SOURCES_LIST; then
 echo 'deb mirror://mirrors.ubuntu.com/mirrors.txt raring main restricted universe multiverse' | cat - /etc/apt/sources.list > /tmp/temp && sudo mv /tmp/temp /etc/apt/sources.list
 echo 'deb mirror://mirrors.ubuntu.com/mirrors.txt raring-updates  main restricted universe multiverse' | cat - /etc/apt/sources.list > /tmp/temp && sudo mv /tmp/temp /etc/apt/sources.list
 echo 'deb mirror://mirrors.ubuntu.com/mirrors.txt raring-backports main restricted universe multiverse' | cat - /etc/apt/sources.list > /tmp/temp && sudo mv /tmp/temp /etc/apt/sources.list
 echo 'deb mirror://mirrors.ubuntu.com/mirrors.txt raring-security main restricted universe multiverse' | cat - /etc/apt/sources.list > /tmp/temp && sudo mv /tmp/temp /etc/apt/sources.list
fi

# Fix ubuntu local issues
echo "LANGUAGE=en_US:en"  >  /etc/default/locale
echo "LC_ALL=en_US.UTF-8" >> /etc/default/locale
echo "LANG=en_US.UTF-8"   >> /etc/default/locale

sudo apt-get update

#install some development tools
sudo apt-get install git -y
sudo apt-get install vim -y

#install postgres and configure postgres for passwordless access - THIS IS NOT PRODUCTION SAFE
sudo apt-get install postgresql-9.1 -y
sed -i -e 's/md5/trust/g' /etc/postgresql/9.1/main/pg_hba.conf
sudo service postgresql stop
sudo service postgresql start

#Install PHP 5.5 and dependencies
sudo apt-get install python-software-properties -y
sudo add-apt-repository ppa:ondrej/php5-experimental -y
sudo apt-get update 
sudo apt-get install php5 -y
sudo apt-get install php5-cli -y
sudo apt-get install php5-pgsql -y
sudo apt-get install php5-xdebug -y
sudo apt-get install php5-readline -y
sudo apt-get install php5-mcrypt -y

#Setup xdebug for remote debugging
XDEBUG_CONFIG_FILE=/etc/php5/mods-available/xdebug.ini
XDEBUG_CONFIG_STRING='xdebug.remote'
REMOTE_HOST='10.0.2.2' #This is the IP of the host as seen by the guest - need to figure a more dynamic way of doing this

if ! grep -q $XDEBUG_CONFIG_STRING $XDEBUG_CONFIG_FILE; then
  echo 'xdebug.remote_enable=true;' >> $XDEBUG_CONFIG_FILE
  echo 'xdebug.remote_handler=dbgp;' >> $XDEBUG_CONFIG_FILE
  echo "xdebug.remote_host=$REMOTE_HOST;" >> $XDEBUG_CONFIG_FILE
  echo 'xdebug.remote_port=9000;' >> $XDEBUG_CONFIG_FILE
  echo 'xdebug.remote_log=/tmp/xdebug_remote.log;' >> $XDEBUG_CONFIG_FILE
fi

#Install composer
if ! which composer.phar > /dev/null; then
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin
else
  echo 'Composer is installed'
fi
