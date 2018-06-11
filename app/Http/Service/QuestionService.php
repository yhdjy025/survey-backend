<?php
/**
 * Created by yhdjy.
 * Email: chenweiE@sailvan.com
 * Date: 2018/6/11
 * Time: 9:30
 */

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;

class QuestionService
{

    /**
     * add question
     * @param $params
     * @return bool
     */
    public function add($params)
    {
        $data = [
            'title'     => $params['title'],
            'sid'       => $params['sid'],
            'type'      => $params['type'],
            'script'    => $params['script'],
            'answer'    => json_encode($params['answer']),
            'xpath'     => json_encode($params['xpath']),
            'create_at' => time()
        ];
        return DB::table('question')->insert($data);
    }

    /**
     * get question
     * @param array $where  search condition
     * @param int $page     page number
     * @param int $perPage      page size
     * @return \Illuminate\Support\Collection
     */
    public function get($where = [], $page = 1, $perPage = 10)
    {
        $db = DB::table('question')
            ->where($where);
        if ($page) {
            $db->paginate($perPage);
        }
        return $db->get();
    }

    /**
     * fin a question
     * @param $title    question title
     * @param int $sid  survey id
     * @return mixed
     */
    public function find($title, $sid = 0)
    {
        $where = [
            ['title', 'like', '%'.$title.'%']
        ];
        if ($sid > 0) {
            $where[] = ['sid', $sid];
        }
        $question = DB::table('question')
            ->where($where)
            ->frist();
        if ($question) {
            $question['answer'] = json_decode($question['answer'], true);
            $question['xpath'] = json_decode($question['xpath'], true);
        }

        return $question;
    }
}