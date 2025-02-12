## Запуск

```
composer install
php artisan key:generate
npm install
npm run dev
```

## Файл языков

```
/lang/en.messages.php
/lang/ru.messages.php
```

## Ссылки на бусти менять отсюда

```
app/Http/Controllers/HomeController.php

$info = [
        [
            'active' => если активно true,
            'url' => 'ссыка1',
        ],
        [
            'active' => если не активно false,
            'url' => 'ссыка1',
        ],
    ];
```
