# IM4-LH-2025

## Prerequisites
- homebrew (https://brew.sh)
- php (Installation: brew install php)
- mariadb (Installation: brew install mariadb)

## Starting and stopping mariadb
brew services start mariadb
brew services stop mariadb

## Setting up root user on mariadb
- sudo mysql -u root
- ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';

## MariaDB credentials (local)
username: root
password: root
 
## Local development setup
- Get the system/config.php. This file creates the database connection and possibly does other things too
- Start php server locally: php -S localhost:8000