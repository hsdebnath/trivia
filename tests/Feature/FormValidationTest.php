<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class FormValidationTest extends TestCase
{
    public function testIndexMethodReturnsFormView()
    {
        $response = $this->get('/'); 
        $response->assertStatus(200);
        $response->assertViewIs('form');
    }

    public function testValidRequestPassesValidation()
    {
        $validator = Validator::make([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'num_questions' => 10,
            'difficulty' => 'easy',
            'type' => 'multiple choice',
        ], (new \App\Http\Requests\SearchHistoryRequest())->rules());

        $this->assertFalse($validator->fails());
    }

    public function testInvalidEmailFailsValidation()
    {
        $validator = Validator::make([
            'full_name' => 'John Doe',
            'email' => 'noemail', // Invalid data
            'num_questions' => 10,
            'difficulty' => 'easy',
            'type' => 'multiple choice',
        ], (new \App\Http\Requests\SearchHistoryRequest())->rules());

        $this->assertTrue($validator->fails());
    }

    public function testInvalidNumberOfQuestionsFailsValidation()
    {
        $validator = Validator::make([
            'full_name' => 'John Doe',
            'email' => 'john@doe.com', 
            'num_questions' => 50,// Invalid data
            'difficulty' => 'easy',
            'type' => 'multiple choice',
        ], (new \App\Http\Requests\SearchHistoryRequest())->rules());

        $this->assertTrue($validator->fails());
    }

    public function testInvalidDifficultyFailsValidation()
    {
        $validator = Validator::make([
            'full_name' => 'John Doe',
            'email' => 'john@doe.com', 
            'num_questions' => 10,
            'difficulty' => 'very easy',// Invalid data
            'type' => 'multiple choice',
        ], (new \App\Http\Requests\SearchHistoryRequest())->rules());

        $this->assertTrue($validator->fails());
    }

    public function testInvalidTypeFailsValidation()
    {
        $validator = Validator::make([
            'full_name' => 'John Doe',
            'email' => 'john@doe.com', 
            'num_questions' => 10,
            'difficulty' => 'easy',
            'type' => 'single choice',// Invalid data
        ], (new \App\Http\Requests\SearchHistoryRequest())->rules());

        $this->assertTrue($validator->fails());
    }
}
