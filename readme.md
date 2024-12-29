# Website Template

Simple template project for working with complete websites locally and sync them with a web hotel.

You will most likely need to change a lots of folder names for it to fit your hosting.

You need to have Docker Desktop installed and the Visual Studio Code extensions listed in `/.vscode/extensions.json` installed.

## Local Docker

Create the file `/httpd.private/settings.php` next to `/httpd.www/` with the contents but replace `192.168.10.111` with your local IP:
```
<?php
    define("DB_HOST", "192.168.10.111:3306");
    define("DB_DATABASE", "develop");
    define("DB_USERNAME", "user");
    define("DB_PASSWORD", "pass");
?>
```
Your file structure should look like this:
```
├── docker-compose.yaml
├── Dockerfile
├── httpd.private
│   └── settings.php
├── httpd.www
│   └── index.php
├── init.sql
├── package.json
├── php.ini
└── readme.md
```

Then your website should work locally Docker by just hitting F5.

It is just assumed the default port for MySQL is not used and the dev port `8000` is also unused.

## Hosting

If you only work locally you can ignore the rest of this readme.

### settings.php

You  need `settings.php` on the actual website with the actual credentials for the real database.

### sql.ini

You need to make sure the tables created in `sql.ini` creates the exact same database tables as you have on your hosting.

### SFTP Syncing

You need a file named `.vscode/sftp.json` that look like this if you want to sync with the real website. Ask for host, username, and password form your DevOps:
```
{
    "name": "Website Template",
    "host": "ASK_FOR_HOST",
    "protocol": "sftp",
    "port": 22,
    "username": "ASK_FOR_USERNAME",
    "password": "ASK_FOR_PASSWORD",
    "remotePath": "/customers/6/6/d/example.com/httpd.www/",
    "uploadOnSave": false,
    "syncMode": "full",
    "context": "./httpd.www",
    "watcher": {
        "files": "**/*",
        "autoUpload": false,
        "autoDelete": false
    },
    "debug": true,
    "ignore": [
        ".htaccess"
    ]
}
```

To upload files to website use `Ctrl+Shit+P` type `SFTP: Sync Local -> Remote` but just typing `sync` is often enough.

You need to pick the local folder so you need to hit enter twice.

### .htaccess

In the actual hosting you might need to create the `httpd.www/.htaccess` file. We can't have it in the repo because it breaks the docker container we use for local development:
```
#Rewrite everything to https
RewriteEngine On
RewriteCond %{HTTPS} !=on
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```
