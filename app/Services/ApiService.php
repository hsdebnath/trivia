<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public static function fetchQuestions($amount, $difficulty, $type)
    {
        $apiResponse = Http::get('https://opentdb.com/api.php', [
            'amount' => $amount,
            'difficulty' => $difficulty,
            'type' => ($type === 'multiple choice') ? 'multiple' : 'boolean',
        ]);

        return $apiResponse->json();
    }
}
