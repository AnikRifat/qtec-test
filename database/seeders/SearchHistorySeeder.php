<?php

use App\Models\UserSearchHistory;
use Illuminate\Database\Seeder;

class SearchHistorySeeder extends Seeder
{
    public function run()
    {
        $history = [
            [
                'keyword' => 'laravel',
                'user_id' => 1,
                'search_time' => '2022-01-01 12:00:00',
                'search_results' => '[{"title":"Laravel - The PHP Framework For Web Artisans","url":"https:\/\/laravel.com\/"}]'
            ],
            [
                'keyword' => 'php',
                'user_id' => 2,
                'search_time' => '2022-02-01 13:00:00',
                'search_results' => '[{"title":"PHP: Hypertext Preprocessor","url":"https:\/\/www.php.net\/"}]'
            ],
            [
                'keyword' => 'javascript',
                'user_id' => 1,
                'search_time' => '2022-03-01 14:00:00',
                'search_results' => '[{"title":"JavaScript | MDN","url":"https:\/\/developer.mozilla.org\/en-US\/docs\/Web\/JavaScript"}]'
            ],
        ];

        foreach ($history as $data) {
            UserSearchHistory::create($data);
        }
    }
}
