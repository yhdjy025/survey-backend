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
        //$this->middleware('auth');
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

    /**
     * edit survey
     * @param int $id
     * @param SurveyService $surveyService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function editSurvey($id = 0, SurveyService $surveyService)
    {
        if (0 == $id) {
            return $this->error('params error');
        }
        if (\request()->isMethod('post')) {
            $data = [
                'title' => \request('title', ''),
                'before' => \request('before', ''),
                'after' => \request('after', '')
            ];
            if (empty($data['title'])) {
                return $this->error('title is not allow empty');
            }
            $ret = $surveyService->update($id, $data);
            if (empty($ret)) {
                return $this->error('update failed');
            }
            return $this->success('update success');
            exit;
        }
        $survey = $surveyService->find($id);
        return view('admin.edit_survey', [
            'survey' => $survey
        ]);
    }

    /**
     * update question
     * @param int $id
     * @param QuestionService $questionService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function editQuestion($id = 0, QuestionService $questionService)
    {
        if (0 == $id) {
            return $this->error('params error');
        }
        if (\request()->isMethod('post')) {
            $data = [
                'title' => \request('title', ''),
                'type' => \request('type', 1),
                'script' => \request('script', ''),
                'xpath' => \request('xpath', []),
                'answer' => \request('answer', [])
            ];
            if (empty($data['title'])) {
                return $this->error('title is not allow empty');
            }
            $ret = $questionService->update($id, $data);
            if (empty($ret)) {
                return $this->error('update failed');
            }
            return $this->success('update success');
            exit;
        }
        $question = $questionService->findById($id);
        return view('admin.edit_question', [
            'question' => $question
        ]);
    }
}
