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

#Install composer
if ! which composer.phar > /dev/null; then
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin
else
  echo 'Composer is installed'
fi
