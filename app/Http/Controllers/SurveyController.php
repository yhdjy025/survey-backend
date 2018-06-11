<?php

namespace App\Http\Controllers;

use App\Http\Service\QuestionService;
use App\Http\Service\SurveyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SurveyController extends Controller
{
    private $surveyService;
    private $questionService;

    public function __construct(SurveyService $surveyService, QuestionService $questionService)
    {
        $this->surveyService = $surveyService;
        $this->questionService = $questionService;
    }

    public function addQuestion()
    {
        $data = [
            'title'  => request('title', ''),
            'sid'    => request('sid', 0),
            'type'   => request('type', 1),
            'script' => request('script', ''),
            'answer' => request('answer', []),
            'xpath'  => request('xpath', [])
        ];
        if (empty($data['title'])) {
            $this->error('params error');
        }
        $ret = $this->questionService->add($data);
        if (empty($ret)) {
            $this->error('failed to add');
        }
        $this->success('success');

    }

    public function addSURVEY()
    {
        $data = [
            'title' => \request('title', ''),
            'before' => \request('before', ''),
            'after' => \request('after', '')
        ];
        $id = $this->surveyService->add($data);
        if (empty($ret)) {
            $this->error('failed to add');
        }
        $this->success('success', $id);
    }
}
