<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Log;
use simplehtmldom\HtmlWeb;

class BudgetRepository
{
    public static function get(array $url): array
    {
        try {
            $client = new HtmlWeb();
            $data = [];

            foreach ($url as $key => $item) {
                $html = $client->load($item['url']);
                if ($html) {
                    $data[$key]['active'] = $item['active'];

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

                    $data[$key]['description'] = $html->find(
                        '.TargetItemMoney_root_Rlgve div.TargetItemCommon_description_j7lxX',
                        0
                    )->plaintext;
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
}
