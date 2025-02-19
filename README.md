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

## Ссылки на стриминги и соц сети
```
  $streemings = [
            ['name' => 'Spotify', 'link' => 'https://open.spotify.com/album/1fyWAF0i2pf0pDPF32Hctd'],
            ['name' => 'Apple', 'link' => 'https://music.apple.com/am/album/hold-me-tight-single/1793972434'],
            ['name' => 'iTunes', 'link' => 'https://music.apple.com/am/album/hold-me-tight-single/1793972434'],
            ['name' => 'Amazon', 'link' => 'https://music.amazon.com/albums/B0DVR3Q7J9?trackAsin=B0DVR5MP9P'],
            ['name' => 'Youtube', 'link' => 'https://www.youtube.com/watch?v=_BmVIX2gl3c'],
            ['name' => 'Tiktok', 'link' => 'https://www.tiktok.com/tag/rominlove'],
        ];

        $socialLinks = [
            ['icon' => 'telegram', 'url' => 'https://telegram.org'],
            ['icon' => 'instagram', 'url' => 'https://instagram.com'],
            ['icon' => 'facebook', 'url' => 'https://www.facebook.com/groups/rominlove'],
            ['icon' => ' fa-x-twitter', 'url' => 'https://x.com/rominlovemusic'],
            ['icon' => 'youtube', 'url' => 'https://youtube.com'],
            ['icon' => 'tiktok', 'url' => 'https://www.tiktok.com/@rominlovemusic'],

        ];
```


## это для меня
```
vendor/simplehtmldom/simplehtmldom/HtmlDocument.php
if (false)  // 130line

