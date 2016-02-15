# Web Based File and Folder Browser
Task is by propertyguru for building a file and folder browser that will look and feel 
similar with the OS X Finder.

## Features
+ Browse any directory (subject to read permission)
+ Support unlimited nested directories
+ Double click to expand/collapse directory
+ Single click on a arrow to expand/collapse directory
+ Directory loading indicator
+ Double click to download file

## Dependency

+ PHP 5.5+
+ Bower
+ jQuery 2.2
+ Bootstrap 3.3.x

## Deployment

* Install bower on targeted machine and install bower dependency using following command in code 
root directory
 
    bower install

* To start application using PHP's builtin web server run

    php -S 0.0.0.0:8080 -t src
    
Or if you want to deploy it using Aapache/Nginx

* Point Document/Root in web server configuration to `src` directory such that the base path of 
application be `/`


# Todo:

+ Unit test
