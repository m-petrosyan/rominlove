<?php

namespace App\Http\Controllers;

use App\Http\Service\BudgetService;
use Inertia\Inertia;
use Inertia\Response;

class HomeController
{
    protected BudgetService $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }

    public function index(): Response
    {
        $info = [
            [
                'active' => true,
                'url' => 'https://boosty.to/rominlove',
                'donate' => 'https://boosty.to/rominlove/single-payment/donation/676886/target?share=target_link',
                'description' => [
                    'ru' => 'Цель - снять музыкальный видеоклип "Hold Me Tight" в Армении. Ваша поддержка будет вознаграждена вашим именем в титрах клипа.',
                    'en' => 'The goal - to shoot a music video clip "Hold Me Tight" in Armenia. Your support will be rewarded with your name in the credits of the video.',
                ],
            ],
//            [
//                'active' => false,
//                'url' => 'https://boosty.to/stavrowitch',
//                'description' => [
//                    'ru' => 'Пример текста',
//                    'en' => 'Text example',
//                ],
//            ],
        ];

        $streemings = [
            ['name' => 'Spotify', 'link' => 'https://open.spotify.com/album/1fyWAF0i2pf0pDPF32Hctd'],
            ['name' => 'Apple', 'link' => 'https://music.apple.com/am/album/hold-me-tight-single/1793972434'],
            ['name' => 'YouTube', 'link' => 'https://www.youtube.com/watch?v=_BmVIX2gl3c'],
            ['name' => 'iTunes', 'link' => 'https://music.apple.com/am/album/hold-me-tight-single/1793972434'],
            ['name' => 'Amazon', 'link' => 'https://music.amazon.com/albums/B0DVR3Q7J9?trackAsin=B0DVR5MP9P'],
            ['name' => 'Deezer', 'link' => 'https://www.deezer.com/en/album/706795761'],
            ['name' => 'Tiktok', 'link' => 'https://www.tiktok.com/tag/rominlove'],
            ['name' => 'Yandex', 'link' => 'https://music.yandex.ru/album/35511343'],
        ];

        $socialLinks = [
            ['icon' => 'telegram', 'url' => 'https://t.me/rominlove'],
            ['icon' => 'instagram', 'url' => 'https://instagram.com/rominlovemusic'],
            ['icon' => 'facebook', 'url' => 'https://www.facebook.com/rominloveworld'],
            ['icon' => ' fa-x-twitter', 'url' => 'https://x.com/rominlovemusic'],
            ['icon' => 'youtube', 'url' => 'https://www.youtube.com/@rominlove'],
            ['icon' => 'tiktok', 'url' => 'https://www.tiktok.com/@rominlove'],

        ];

        $data = $this->budgetService->get($info);

        return Inertia::render('Welcome', [
            'data' => $data,
            'translations' => trans('messages'),
            'streemings' => $streemings,
            'socialLinks' => $socialLinks,
        ]);
    }
}

