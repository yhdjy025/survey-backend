<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    private $surveyService;

    public function __construct()
    {

    }

    public function addQuestion()
    {
        $title = request('title');
        $title = trim($title);
        if ($title == '') {
            echo '参数错误';
            die;
        }
        $question = DB::table('question')
            ->where('title', 'like', '%' . $title . '%')
            ->first();
        if (empty($question)) {
            $type = 'add';
            $data = view('survey.add', ['title' => $title])->render();
        } else {
            $type = 'cheeck';
            $question->answer = json_decode($question->answer, true);
            $data = $question;
        }
        return response()->json([
            'status' => 1,
            'type' => $type,
            'data' => $data,
            'msg' => 'success'
        ]);
    }

    public function add()
    {
        $title = request('title', '');
        if (empty($title)) {
            return response()->json([
                'status' => 0,
                'msg'    => 'title is not allowed empty'
            ]);
        }
        $id = DB::table('survey')
            ->where('title', $title)
            ->value('id');
        if (empty($id)) {
            $id = DB::table('survey')->insertGetId(['title' => $title, 'create_at' => time()]);
        }
        return response()->json([
            'status' => 1,
            'msg'    => 'success',
            'id'     => $id
        ]);
    }

    public function save()
    {
        $title = request('title', '');
        $answer = request('answer', []);
        $sid = request('sid', 0);
        if (0 == $sid) {
            response()->json([
                'status' => 0,
                'msg' => '请先设置调查'
            ]);
            exit;
        }
        $data = [
            'sid'       => $sid,
            'title'     => $title,
            'answer'    => json_encode($answer),
            'create_at' => time()
        ];
        $ret = DB::table('question')->insert($data);
        if ($ret) {
            return response()->json([
                'status' => 1,
                'msg'    => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'msg'    => 'error'
            ]);
        }
    }
}
