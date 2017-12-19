Wall
-

This is simple DDD example in PHP.

The project - it is a simple wall
where everyone can left some message or advertising or picture or something else...

# Technical side of project.

Architecture:

````
wall
└── src
    ├── app
    │   ├── config
    │   ├── implementation
    │   │   ├── laravel
    │   │   ├── phalcon
    │   │   ├── plainphp
    │   │   └── symfony
    │   ├── kernel
    │   │   ├── Di.php
    │   │   └── Exception
    │   ├── migrations
    │   └── var
    ├── bin
    ├── ddd
    │   └── Wall
    │       ├── Application
    │       │   ├── Exception
    │       │   ├── Service
    │       │   └── VO
    │       ├── Domain
    │       │   ├── Model
    │       │   └── Service
    │       └── Infrastructure
    │           ├── FullTextSearching
    │           │   └── ElasticSearch
    │           ├── Logging
    │           ├── Messaging
    │           └── Persistence
    │               ├── CSV
    │               ├── Mongo
    │               └── MySql
    └── web
        ├── css
        ├── html
        │   └── implementation
        │       ├── jquery
        │       └── react
        ├── js
        │   └── implementation
        │       ├── jquery
        │       └── react
        ├── phalcon
        └── plainphp
````
