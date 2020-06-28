
DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      nodejs/             server.js -> get data from server without sending request from client
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


Getting Started
-------------------
1. run ```composer install``` to install the framework and its components
2. run ```npm install``` to install the node modules
3. edit database config at ```config/db.php```

Database 
-------------------
Apply the database migration to create the table required to store the chatting messages

```
php yii migrate/up
```

Running Node Service
-------------------

```
node server.js
```

Preview
-------------------
![Alt Text](https://media.giphy.com/media/cdI8Myrv9GkSG3KIPp/giphy.gif)
