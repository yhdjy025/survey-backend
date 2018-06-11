<?php
/**
 * Created by PhpStorm.
 * User: yhdjy
 * Date: 2018/6/5
 * Time: 23:46
 */

namespace App\Http\Service;


use App\Exceptions\AppException;
use Illuminate\Support\Facades\DB;

class SurveyService
{

    /**
     * add a survey
     * @param $params   survey params
     * @return int      return survey id
     * @throws AppException
     */
    public function add($params)
    {
        $exist = \DB::table('survey')
            ->where('title', $params['title'])
            ->value('id');
        if ($exist) {
            throw new AppException('the survey is exist');
        }
        $data = [
            'title' => $params['title'],
            'before' => $params['before'],
            'after' => $params['after'],
            'create_at' => time()
        ];
        return DB::table('survey')->insertGetId($data);
    }

    /**
     * get survey page list
     * @param array $where search condition
     * @param int   $perPage page size
     * @return \Illuminate\Support\Collection   return result collection
     */
    public function getList($where = [], $perPage = null)
    {
        $db = DB::table('survey')->where($where);
        if ($perPage) {
            return $db->paginate($perPage);
        }
        return $db->get();
    }

    /**
     * delete survey and questions by survey id
     * @param $id       survey id
     * @return bool     succes- return true  error db exceptioon
     * @throws \Exception
     * @throws \Throwable
     */
    public function delete($id)
    {
        DB::transaction(function() use ($id) {
           DB::table('question')->where('sid', $id)->delete();
           DB::table('survey')->where('id', $id)->delete();
        });
        return true;
    }

    /**
     * get a survey
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function find($id)
    {
        return DB::table('survey')
            ->where('id', $id)
            ->first();
    }
}