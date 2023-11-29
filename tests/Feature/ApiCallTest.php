<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;

class ApiCallTest extends TestCase
{
    public function testFetchQuestionsReturnsJsonResponse()
    {
        Http::fake([
            'https://opentdb.com/api.php' => Http::response(['results' => ['sample_question']], 200),
        ]);

        $jsonResponse = ApiService::fetchQuestions(5, 'easy', 'multiple choice');

        $this->assertIsArray($jsonResponse);
        $this->assertArrayHasKey('results', $jsonResponse);
        $this->assertIsArray($jsonResponse['results']);
        $this->assertNotEmpty($jsonResponse['results']);
    }

    public function testApiReturnsEmptyResult()
    {
        Http::fake([
            'https://opentdb.com/api.php' => Http::response([], 200),
        ]);

        // Calling the fetchQuestions method
        $jsonResponse = ApiService::fetchQuestions(5, 'easy', 'multiple choice');

        // Assertions
        $this->assertIsArray($jsonResponse);
        $this->assertEmpty($jsonResponse); 
    }
}
