update_repo() {     
  sudo apt-get update -o Dir::Etc::sourcelist="sources.list.d/$1.list" -o Dir::Etc::sourceparts="-" -o APT::Get::List-Cleanup="0"; 
}

PHP_REPO='/etc/apt/sources.list.d/ondrej-php5-raring.list'
if [ -f $PHP_REPO ];then
  echo "PHP5.5  repo already added"
else
  echo "Adding PHP5.5 repo"
  sudo apt-get install python-software-properties -y
  sudo add-apt-repository ppa:ondrej/php5 -y
  update-repo ondrej-php5-raring  
fi
