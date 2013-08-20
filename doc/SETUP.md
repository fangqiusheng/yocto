#Setup for Developers

 - fork the repo

 Click Fork in GitHub, and choose your username if asked

 - clone the source to your dev container

 `git clone git@github.com:{YOUR_GITHUB_USERNAME}/yocto`

 - install the vhost

 `cp app/config/vhost.conf /your/vhosts/folder/yocto.conf`

 - reload apache

 - Install latest composer installer phar

 `curl -sS https://getcomposer.org/installer | php`

 - install the dependencies

 `php ../composer.phar install`

 - Read the Contributing guidelines

 [CONTRIBUTING.md](../CONTRIBUTING.md)
