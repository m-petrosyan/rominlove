<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use simplehtmldom\HtmlWeb;

class BudgetService
{
    public function get(array $url): array
    {
        try {
            $client = new HtmlWeb();
            $data = [];

            foreach ($url as $key => $item) {
                $html = $client->load($item['url']);
                if ($html) {
                    $data[$key] = $item;

                    $data[$key]['collected'] = preg_match(
                        '/\d+/',
                        $html->find(
                            '.TargetItemMoney_root_Rlgve span.TargetItemCommon_collectedTextTarget_McKGZ',
                            0
                        )->plaintext,
                        $matches
                    ) ? $matches[0] : '';


                    $data[$key]['target'] = preg_replace(
                        '/[^\d]/',
                        '',
                        $html->find(
                            '.TargetItemMoney_root_Rlgve span.TargetItemCommon_collectedTextTarget_McKGZ',
                            1
                        )->plaintext
                    );

                    if (Session::get('locale') === 'en') {
                        $data[$key]['collected'] = $data[$key]['collected'] / $this->getRubExchangeRate('USD');
                        $data[$key]['target'] = $data[$key]['target'] / $this->getRubExchangeRate('USD');
                    }
                } else {
                    throw new \Exception('Failed to load HTML');
                }
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $data = [];
        }


        usort($data, function ($a, $b) {
            return $b['active'] <=> $a['active'];
        });

        return $data;
    }


    function getRubExchangeRate($currency = 'USD')
    {
        $response = Http::get('https://www.cbr-xml-daily.ru/daily_json.js');

        if ($response->successful()) {
            $data = $response->json();

            return $data['Valute'][$currency]['Value'] ?? null;
        }

        return null;
    }
}
