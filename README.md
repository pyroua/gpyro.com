<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">GPYRO yii2 project</h1>
    <br>
</p>

СТРУКТУРА ДИРЕКТОРІЙ
-------------------

```
common               загальні файли і компоненти
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    

console             консольні команди
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime

backend             адмінка
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources

frontend            клієнтський інтерфейс
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```

Конфігурація
-------------------
У кореневій папці проекту:
```
common/config/db.php.dist скопыювати як common/config/db.php і внести свої дані по своїй БД 
```

Nginx

В конфіги фронта і бекенда додати:

```
    # всі запити директорії сторедж перенаправляєм в вище web директорії
    #при спробі запросити неіснуючий файл редіректим  на індекс
    location /storage {
        root  /var/www/gpyro.com; # рут директорія конкретної машини
        try_files $uri /storage/$uri;
        
        location /storage {
            try_files $uri $uri/ /index.php$is_args$args;
        }
    }

```

Ініціалізація
-------------------

Вендори під гітом, тому спочатку потрібно проінсталити модулі

```
composer install 
```

далі ініціалізуєм апп
```
php init 
php yii migrate 
```

Веб сервер натравлюєм на бекенд і фронтенд індекс файли

```
backend/web/index.php
frontend/web/index.php
```