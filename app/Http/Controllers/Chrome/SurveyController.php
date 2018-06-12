<?php

namespace App\Http\Controllers\Chrome;

use App\Http\Service\QuestionService;
use App\Http\Service\SurveyService;
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

    /**
     * add question
     */
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
        return $this->success('success');

    }

    /**
     * add survey
     * @throws \App\Exceptions\AppException
     */
    public function addSurvey()
    {
        $data = [
            'title'  => request('title', ''),
            'before' => request('before', ''),
            'after'  => request('after', '')
        ];
        $id = $this->surveyService->add($data);
        if (empty($id)) {
            return $this->error('failed to add');
        }
        $data['id'] = $id;
        return $this->success('success', $data);
    }

    /**
     * select survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectSurvey()
    {

        return view('survey.select');
    }


    public function searchSurvey()
    {
        $title = request('title', '');
        
    }
}
