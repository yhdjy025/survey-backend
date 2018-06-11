<?php

namespace App\Http\Controllers\Admin;

use App\Http\Service\QuestionService;
use App\Http\Service\SurveyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * survey list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function survey(SurveyService $surveyService)
    {
        $title = \request('title', '');
        $where = [];
        if ($title) {
            $where[] = ['title', 'like', '%'.$title.'%'];
        }
        $list = $surveyService->getList($where, 10);

        return view('admin.survey', [
            'list' => $list
        ]);
    }

    /**
     * list survey questions
     * @param QuestionService $questionService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function question(SurveyService $surveyService,  QuestionService $questionService)
    {
        $sid = \request('sid', '');
        $title = \request('title', '');
        $where = [['sid', $sid]];
        if ($title) {
            $where[] = ['title', 'like', '%'.$title.'%'];
        }
        $survey = $surveyService->find($sid);
        $list = $questionService->getList($where, 10);

        return view('admin.question', [
            'list' => $list,
            'survey' => $survey
        ]);
    }

    /**
     * delete survey or question
     * @param SurveyService   $surveyService
     * @param QuestionService $questionService
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function delete(SurveyService $surveyService,  QuestionService $questionService)
    {
        $type = \request('type', 'survey');
        $id = \request('id', 0);
        if (0 == $id) {
            return $this->error('params error');
        }
        if ('survey' == $type) {
            $ret = $surveyService->delete($id);
        } else {
            $ret = $questionService->delete($id);
        }

        if (empty($ret)) {
            return $this->error('failed to delete it');
        }
        return $this->success('delete success');
    }
}
