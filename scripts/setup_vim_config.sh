#Install neo vim-config on you vagrant box
sudo apt-get install rake
mkdir ~/workspace
git clone https://github.com/neo/vim-config.git ~/workspace/vim-config
cd ~/workspace/vim-config 
rake
