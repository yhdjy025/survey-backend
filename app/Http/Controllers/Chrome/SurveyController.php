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
        $sid = request('sid', 0);
        if (0 == $sid) {
            return $this->error('参数错误');
        }
        if (request()->isMethod('post')) {
            $data = [
                'title'  => request('title', ''),
                'sid'    => $sid,
                'type'   => request('type', 1),
                'script' => request('script', ''),
                'answer' => request('answer', []),
                'xpath'  => request('xpath', []),
                'random' => request('random', [])
            ];
            if (empty($data['title'])) {
                return $this->error('参数错误');
            }
            $ret = $this->questionService->add($data);
            if (empty($ret)) {
                return $this->error('添加题目失败');
            }
            return $this->success('添加如题目成功');
            exit;
        }
        $title = request('title', '');
        return view('survey.add_question', ['sid' => $sid, 'title' => $title]);
    }

    /**
     * add survey
     * @throws \App\Exceptions\AppException
     */
    public function addSurvey()
    {
        $data = [
            'title'     => request('title', ''),
            'before'    => request('before', ''),
            'after'     => request('after', ''),
            'get_title' => request('get_title', ''),
            'next'      => request('next', '')
        ];
        if (empty($data['title'])) {
            return $this->error('标题不能为空');
        }
        $id = $this->surveyService->add($data);
        if (empty($id)) {
            return $this->error('添加调查失败');
        }
        $data['id'] = $id;
        return $this->success('添加调查成功', $data);
    }

    /**
     * select survey
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectSurvey()
    {
        $survey = $this->surveyService->getList([], 20);
        return view('survey.select', ['survey' => $survey]);
    }

    /**
     * search survey
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function searchSurvey()
    {
        $title = request('title', '');
        $where[] = ['title', 'like', '%' . $title . '%'];
        $list = $this->surveyService->getList($where, false);
        $html = view('survey.search_survey', ['list' => $list])->render();
        return $this->success('success', $html);
    }

    /**
     * find question by title
     * @return \Illuminate\Http\JsonResponse
     */
    public function findQuestion()
    {
        $title = request('title', '');
        if (empty($title)) {
            return $this->error('参数错误');
        }
        $question = $this->questionService->find($title);
        if (empty($question)) {
            return $this->error('未找到题目');
        }
        return $this->success('找到了', $question);
    }

    public function getInfo($country = 'us')
    {
        switch ($country) {
            case 'us':
                $url = 'http://www.haoweichi.com/Index/random';
                break;
            case 'uk':
                $url = 'http://haoweichi.com/Others/ying_guo_shen_fen_sheng_cheng';
                break;
        }
        echo file_get_contents($url);
    }
}
