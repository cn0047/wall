Scenarios:

`Given -> When -> Then`

1. Index page is opened -> No action -> First batch of messages is rendered.
2. Index page is opened -> Reached bottom of page -> Next batch of messages is rendered.
3. Index page is opened -> "Add" button is pressed -> "New message" popup is opened.
4. "New message" popup is filled -> "New message" popup is submitted -> New message is added in top of page.

TODO:
1. Likes.
2. Comments.
3. Premium message.
4. Search.
5. User profile.

ARCHITECTURE:
````
├── README.md
└── wall
    ├── composer.json
    ├── src
    │   ├── app
    │   │   ├── config
    │   │   ├── implementation
    │   │   │   ├── laravel
    │   │   │   ├── phalcon
    │   │   │   ├── plainphp
    │   │   │   └── symfony
    │   │   ├── migrations
    │   │   │   └── mysql
    │   │   └── var
    │   │       ├── cache
    │   │       └── logs
    │   ├── bin
    │   │   └── cli.php
    │   ├── ddd
    │   │   └── Wall
    │   │       ├── Application
    │   │       ├── Domain
    │   │       │   ├── Model
    │   │       │   └── Service
    │   │       └── Infrastructure
    │   │           ├── FullTextSearching
    │   │           │   └── ElasticSearch
    │   │           ├── Logging
    │   │           ├── Messaging
    │   │           └── Persistence
    │   │               ├── Doctrine
    │   │               ├── Mongo
    │   │               └── PDO
    │   └── web
    └── tests

````
