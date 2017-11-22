# gocron-frontend
- A javascript web app for managing your `gocron` server. 
- https://github.com/jsirianni/gocron

## Installation
Installation is easy, simply server the files using a web server such as Apache or NGINX. 
- Configure the database config file and place it in `/etc/gocron/dbconfig.ini`

The web server should be configured to use authentication and SSL. This configuration is up to the user. 

## Usage
Simply hit the `index.php` page to view active jobs and to delete old jobs. The status column will indicate any missed jobs.
 
