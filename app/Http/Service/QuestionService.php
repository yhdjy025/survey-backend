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
    public function getList($where = [], $perPage = null)
    {
        $db = DB::table('question')
            ->where($where);
        if ($perPage) {
            return $db->paginate($perPage);
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
            ->first();
        if ($question) {
            $question->answer = json_decode($question->answer, true);
            $question->xpath = json_decode($question->xpath, true);
        }

        return $question;
    }

    /**
     * update survey
     * @param $id
     * @param $data
     * @return int
     */
    public function update($id, $data) {
        $data['xpath'] = json_encode($data['xpath']);
        $data['answer'] = json_encode($data['answer']);
        return DB::table('question')
            ->where('id', $id)
            ->update($data);
    }

    /**
     * find question by id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function findById($id)
    {
        $question = DB::table('question')
            ->where('id', $id)
            ->first();
        $question->xpath = $question->xpath ? json_decode($question->xpath, true) : [];
        $question->answer = $question->answer ? json_decode($question->answer, true) : [];

        return $question;
    }

    /**
     * delete question
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return DB::table('question')->where('id', $id)->delete();
    }
}