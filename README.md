# Docker template for PHP projects
This repository provides a starting template for PHP application development.

It contains:
* NGINX webserver
* PHP FastCGI Process Manager with PDO MySQL support
* MariaDB (GPL MySQL fork)
* PHPMyAdmin

## Installation

1. Install Docker Desktop on Windows or Mac, or Docker Engine on Linux.
1. Clone the project

## Usage

In a terminal, run:
```bash
docker-compose up -d 
```

NGINX will now serve files in the /public folder. Visit localhost in your browser to check.
PHPMyAdmin is accessible on localhost:8080
username: root
password: secret123

If you want to stop the containers, press Ctrl+C. 
Or run:
```bash
docker-compose down
```

Folder structure:

root
|
+-- app
|   |
|   +-- controllers
|   |
|   +-- core
|   |
|   +-- models
|   |
|   +-- repositories
|   |
|   +-- services
|   |
|   +-- views
|
+-- public
    |
    +-- css
    |
    +-- favicons
    |
    +-- js

# Webadress of the website

- http://62.250.182.52/

# Login to the website
Feel free to create your own account, but if you want to login with an existing account, you can use the following credentials:

- email: luke.huisman@yahoo.nl  
- password: password1
- type: dungeon master

- email: lukaotte@gmail.com
- password: password2
- type: player

# SQl database script is located in the root folder of the project
You will need to run this script in your database to create the database and tables in order to run the website.

# Notes
Quick note: I have not implemented an Api, I didn't know how
Ps. please review and give feedback, I would love to hear it!
Good luck and have fun Mark!