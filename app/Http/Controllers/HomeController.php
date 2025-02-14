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
                'description' => [
                    'ru' => 'Цель - снять музыкальный видеоклип "Hold Me Tight" в Армении. Ваша поддержка будет вознаграждена вашим Boosty Name в титрах видео.',
                    'en' => 'The goal - to shoot a music video clip "Hold Me Tight" in Armenia. Your support will be rewarded with your Boosty Name in the credits of the video.',
                ],
            ],
            [
                'active' => false,
                'url' => 'https://boosty.to/stavrowitch',
                'description' => [
                    'ru' => 'Пример текста',
                    'en' => 'Text example',
                ],
            ],
        ];

        $data = $this->budgetService->get($info);

        return Inertia::render('Welcome', [
            'data' => $data,
            'translations' => trans('messages'),
        ]);
    }
}

