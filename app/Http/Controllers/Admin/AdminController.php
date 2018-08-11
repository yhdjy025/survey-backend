<?php

namespace App\Http\Controllers\Admin;

use App\Http\Service\QuestionService;
use App\Http\Service\SurveyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redis;

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
                'title'     => request('title', ''),
                'before'    => request('before', ''),
                'after'     => request('after', ''),
                'get_title' => request('get_title', ''),
                'next'      => request('next', '')
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

    public function getip()
    {
        $ip = $this->get_ip();
        file_put_contents('ip.txt', $ip);
        echo $ip;
        die;
    }

    //不同环境下获取真实的IP
    public function get_ip(){
        $ip=false;
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ips=explode (', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            if($ip){ array_unshift($ips, $ip); $ip=FALSE; }
            for ($i=0; $i < count($ips); $i++){
                if(!preg_match ('/^(10│172.16│192.168)./', $ips[$i])){
                    $ip=$ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    public function getproxy()
    {
        $url1 = 'http://tpv.daxiangdaili.com/ip/?tid=555696835160805&num=1&delay=1&category=2&filter=on';
        $url2 = 'http://www.xsdaili.com/get?orderid=113423170816400&num=1&carrier=2&protocol=2&an_ha=1&sp1=1&dedup=1&gj=1';
        $url3 = 'http://www.15daili.com/apiProxy.ashx?un=yhdjy025&pw=chenwei59420&count=1&guolv=1';
        //无忧代理
        $url4 = 'http://api.ip.data5u.com/dynamic/get.html?order=ef07850ac3e9c990e9aa2461c7203306&sep=3';
        $content = file_get_contents($url4);
        echo $content;
    }
}
