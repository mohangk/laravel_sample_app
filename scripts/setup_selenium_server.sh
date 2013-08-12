#/bin/bash

SELENIUM_SERVER='/vagrant/scripts/selenium-server-standalone-2.35.0.jar'
if [ -f $SELENIUM_SERVER ];then
  echo "Selenium server installed"
else
  echo "Downloading selenium server"
  curl https://selenium.googlecode.com/files/selenium-server-standalone-2.35.0.jar > $SELENIUM_SERVER
fi
