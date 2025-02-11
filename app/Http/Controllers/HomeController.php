<?php

namespace App\Http\Controllers;

use App\Http\Repository\BudgetRepository;
use Inertia\Inertia;
use Inertia\Response;

class HomeController
{
    public function index(): Response
    {
        $info = [
            [
                'active' => true,
                'url' => 'https://boosty.to/rominlove',
            ],
            [
                'active' => false,
                'url' => 'https://boosty.to/stavrowitch',
            ],
        ];

        $data = BudgetRepository::get($info);

        return Inertia::render('Welcome', [
            'data' => $data,
        ]);
    }
}

