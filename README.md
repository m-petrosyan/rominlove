## Css файл

```
resources/css/style.css

после чего нужно вводкить команду  npm run build 
```

## Файл языков

```
/lang/en.messages.php
/lang/ru.messages.php
```

## Ссылки на бусти менять отсюда и динамически текст

```
app/Http/Controllers/HomeController.php

    $info = [
            [
                'active' => true,
                'url' => 'https://boosty.to/rominlove',
                'description' => [
                    'ru' => 'Цель - снять музыкальный видеоклип "Hold Me Tight" в Армении. Ваша поддержка будет вознаграждена вашим Boosty Name в титрах видео.',
                    'en' => 'The goal - to shoot a music video clip "Hold Me Tight" in Armenia. Your support will be rewarded with your Boosty Name in the credits of the video.',
                ],
            ],
        ],
```

vendor/simplehtmldom/simplehtmldom/HtmlDocument.php
if (false)  // 130line

