<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\SearchHistoryRequest;
use App\Models\SearchHistory;
use App\Services\ApiService;

class Controller extends BaseController
{
    public function index()
    {
        return view('form');
    }

    public function store(SearchHistoryRequest $request)
    {
        try {
            $jsonResponse = ApiService::fetchQuestions(
                $request->num_questions,
                $request->difficulty,
                $request->type
            );
    
            if (isset($jsonResponse['results'])) {
                $responseData = $jsonResponse['results'];
    
                // Save data to database
                SearchHistory::create($request->all());
    
                $filteredData = array_filter($responseData, function ($question) {
                    return $question['category'] !== "Entertainment: Video Games";
                });
    
                $filteredData = array_map(function ($question) {
                    return [
                        'category' => html_entity_decode($question['category'], ENT_QUOTES),
                        'question' => html_entity_decode($question['question'], ENT_QUOTES),
                        'options' => array_merge([$question['correct_answer']], $question['incorrect_answers']),
                    ];
                }, $filteredData);
    
                if (!empty($filteredData)) {
                    usort($filteredData, function ($a, $b) {
                        return strcmp($a['category'], $b['category']);
                    });
    
                    return view('quiz', ['questions' => $filteredData]);
                } else {
                    return view('form')->with('error', 'Questions Got Filtered Out');
                }
            } else {
                return view('form')->with('error', 'Could not find any Questions for you, Please Try again !');
            }
        } catch (\Exception $e) {
            return view('form')->with('error', 'An error occurred while processing your request'.$e);
        }
    }    

    public function submit(Request $request)
    {
        $userAnswers = $request->input('answers');
        return view('answers', ['userAnswers' => $userAnswers]);
    }

    public function show()
    {
        $history = SearchHistory::paginate(5);
        return view('search-history', ['history' => $history]);
    }
}
