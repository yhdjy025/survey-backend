<?php
/**
 * Created by PhpStorm.
 * User: yhdjy
 * Date: 2018-08-25
 * Time: 10:34
 */

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class BrushService
{
    /**
     * 获取分组的小时权重
     * @param string $group
     * @return \Illuminate\Support\Collection
     */
    public function getWeight($group = 'group1')
    {
        $weight = DB::table('brush_daily_weight')
            ->where('group', $group)
            ->orderBy('hour', 'asc')
            ->get();
        return $weight;
    }

    /**
     * 获取导航链接
     * @param array $map
     * @return \Illuminate\Support\Collection
     */
    public function getUrls($map = [])
    {
        $db = DB::table('brush_url');
        if (!empty($map)) {
            $db->where($map);
        }
        return $db->get();
    }

    /**
     * 更新导航链接
     * @param $id
     * @param $data
     * @return int
     */
    public function updateUrl($id, $data)
    {
        return DB::table('brush_url')
            ->where('id', $id)
            ->update($data);
    }

    /**
     * 获取今日任务
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function getTodayTask($group = 'group1')
    {
        $day = date('Y-m-d');
        return DB::table('brush_task')
            ->where('day', $day)
            ->where('group', $group)
            ->where('is_completed', 0)
            ->first();
    }

    /**、
     * 获取任务列表
     * @param array $map
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getTaskList($map = [])
    {
        $db = DB::table('brush_task')
            ->orderBy('day', 'desc');
        if (!empty($map)) {
            $db->where($map);
        }
        return $db->paginate(10);
    }

    /**
     * 完成任务
     * @param $taskId
     * @return int
     */
    public function setTaskCompleted($taskId)
    {
        return DB::table('brush_task')
            ->where('id', $taskId)
            ->update(['is_completed' => 1]);
    }

    /**
     * 设置任务进度
     * @param $taskId
     * @param $hour
     * @param $ip
     * @param $port
     * @param $time
     * @return int
     */
    public function setTaskProgress($taskId, $hour, $ip, $port, $time)
    {
        $task = DB::table('brush_task')->find($taskId);
        if ($task->num == $task->completed_num) {
            return DB::table('brush_task')
                ->where('id', $taskId)
                ->update(['is_completed' => 1]);
        } else {
            DB::table('brush_task')
                ->where('id', $taskId)
                ->increment('completed_num');
            DB::table('brush_ip')->insert([
                'task_id'    => $taskId,
                'hour'       => $hour,
                'group'      => $task->group,
                'ip'         => $ip,
                'port'       => $port,
                'created_at' => time(),
                'time'       => $time
            ]);
            return DB::table('brush_task_hour')
                ->where('task_id', $taskId)
                ->where('hour', $hour)
                ->increment('completed_num');
        }
    }

    /**
     * 添加任务
     * @param $params
     * @throws \Throwable
     */
    public function addTask($params)
    {
        $task = [
            'group' => $params['group'] ?? 'group1',
            'day' => $params['day'] ?? date('Y-m-d'),
            'num' => $params['num'] ?? 0,
            'created_at' => time()
        ];
        $ret = DB::table('brush_task')
            ->where('group', $task['group'])
            ->where('day', $task['day'])
            ->first();
        if (!empty($ret)) {
            throw new Exception('任务已经存在，不能重复添加', 1003);
        }
        $weight = $this->getWeight($task['group']);
        DB::transaction(function () use ($task, $weight) {
            $taskId = DB::table('brush_task')->insertGetId($task);
            $taskHours = [];
            $sum = $weight->sum('weight');
            foreach ($weight as $item) {
                $taskHours[] = [
                    'hour' => $item->hour,
                    'task_id' => $taskId,
                    'num' => round($item->weight / $sum * $task['num'])
                ];
            }
            DB::table('brush_task_hour')->insert($taskHours);
        });
    }

    /**
     * 删除任务
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public function deleteTask($id)
    {
        if (empty($id)) return false;
        DB::transaction(function () use ($id) {
            DB::table('brush_task')->delete($id);
            DB::table('brush_task_hour')->where('task_id', $id)->delete();
        });
    }

    /**
     * 获取任务小时任务数量
     * @param $taskId
     * @param $hour
     * @return mixed
     */
    public function getTaskHourNum($taskId, $hour)
    {
        return DB::table('brush_task_hour')
            ->where('task_id', $taskId)
            ->where('hour', $hour)
            ->value('num');
    }

    /**
     * 获取任务详情
     * @param $taskId
     * @return \Illuminate\Support\Collection
     */
    public function getTaskInfo($taskId)
    {
        return DB::table('brush_task_hour')
            ->where('task_id', $taskId)
            ->orderBy('hour', 'asc')
            ->get();
    }

    /**
     * 火球任务小时详情
     * @param $taskId
     * @param $hour
     * @return \Illuminate\Support\Collection
     */
    public function getHourInfo($taskId, $hour)
    {
        return DB::table('brush_ip')
            ->where('task_id', $taskId)
            ->where('hour', $hour)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * 获取代理
     * @return bool|mixed
     */
    public function getProxy()
    {
        $socks5 = 'http://ip.11jsq.com/index.php/api/entry?method=proxyServer.generate_api_url&packid=0&fa=0&fetch_key=&qty=1&time=1&pro=&city=&port=2&format=json&ss=5&css=&et=1&dt=0&specialTxt=3&specialJson=';
        $http = 'http://ip.11jsq.com/index.php/api/entry?method=proxyServer.generate_api_url&packid=0&fa=0&fetch_key=&qty=1&time=1&pro=&city=&port=1&format=json&ss=5&css=&et=1&dt=0&specialTxt=3&specialJson=';
        $times = 3;
        while ($times) {
            $contrent = file_get_contents($socks5);
            $data = json_decode($contrent, true);
            if ($data['success'] == true) {
                $result = current($data['data']);
                $result['Type'] = 'socks5';
                return $result;
            }
            $times --;
            sleep(1);
        }
        return false;
    }
}