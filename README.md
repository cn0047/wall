Wall
-

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/7ef23824b0fb40dab08b975b102005db)](https://app.codacy.com/app/cn007b/wall?utm_source=github.com&utm_medium=referral&utm_content=cn007b/wall&utm_campaign=badger)
[![Maintainability](https://api.codeclimate.com/v1/badges/f4018b786b58e19ce92e/maintainability)](https://codeclimate.com/github/cn007b/wall/maintainability)

This is simple **wall**
<br>where everyone can left any message or advertising or picture or something else...

# Technical side of project.

This is simple DDD example in PHP.
<br>This project has high-level abstraction over **database**,
**php** framework, **javascript** framework and so on and so forth.

Architecture:

````
wall
└── src
    ├── 🗂 app                             # Stuff common for all PHP and JavaScript frameworks.
    │   │
    │   ├── 🗂 config                      # All project's configs.
    │   │                                  # Any particular PHP implementation must use these configs.
    │   │
    │   ├── 🗂 implementation              # PRESENTATION LAYER.
    │   │   ├── 🗂 laravel
    │   │   ├── 🗂 phalcon
    │   │   ├── 🗂 plainphp
    │   │   └── 🗂 symfony
    │   │
    │   ├── 🗂 kernel
    │   │   ├── 🗂 Exception               # Kernel exceptions.
    │   │   └── Di.php                     # Simple DIC container.
    │   │                                  # One for any PHP framework implementation (with purpose to support DRY).
    │   │                                  # This DIC also performs common stuff like init bridges, init facades
    │   │                                  # with custom logic which is common for all PHP implementations.
    │   │
    │   ├── 🗂 migrations                  # Framework agnostic DB migrations.
    │   └── 🗂 var                         # Cache, logs, etc.
    │
    ├── 🗂 bin                             # All binary files must be hosted here (artisan, console, migration, etc).
    │
    ├── 🗂 ddd                             # All stuff related to DDD.
    │   └── Wall
    │       ├── 🗂 Application             # 🔰 APPLICATION DDD LAYER.
    │       │   │                          # Any PHP implementation can work only with this layer.
    │       │   │
    │       │   ├── 🗂 Exception
    │       │   ├── 🗂 Service
    │       │   └── 🗂 VO                  # Any request must be represented by VO.
    │       │
    │       ├── Domain                     # 🔰 DOMAIN DDD LAYER.
    │       │   ├── 🗂 Model
    │       │   └── 🗂 Service
    │       │
    │       └── Infrastructure             # 🔰 INFRASTRUCTURE DDD LAYER.
    │           ├── 🗂 FullTextSearching
    │           │   └── 🗂 ElasticSearch
    │           ├── 🗂 Logging
    │           └── 🗂 Persistence         # Implements all domain interfaces and returns canonical DTOs as result.
    │               ├── 🗂 MongoDB
    │               └── 🗂 MySql
    │
    └── 🗂 web                             # USER INTERFACE LAYER (public stuff).
        ├── 🗂 css
        │
        ├── 🗂 html
        │   └── implementation
        │       ├── 🗂 jquery              # Index page for SPA based on jQuery.
        │       └── 🗂 react               # Index page for SPA based on ReactJS.
        │
        ├── 🗂 js                          # FRONTEND.
        │   └── implementation
        │       ├── 🗂 jquery              # jQuery scripts.
        │       └── 🗂 react               # ReactJS components, etc.
        │
        ├── 🗂 laravel                     # Laravel entry point.
        ├── 🗂 phalcon                     # Phalcon entry point.
        ├── 🗂 plainphp                    # PlainPHP entry point.
        └── 🗂 symfony                     # Symfony entry point.
````
