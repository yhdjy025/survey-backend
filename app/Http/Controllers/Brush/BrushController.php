<?php
/**
 * Created by PhpStorm.
 * User: yhdjy
 * Date: 2018-08-25
 * Time: 9:53
 */

namespace App\Http\Controllers\Brush;


use App\Http\Controllers\Controller;
use App\Http\Service\BrushService;
use Mockery\Exception;
use Cache;
use phpDocumentor\Reflection\Types\Self_;

class BrushController extends Controller
{
    private $brushService;
    const DEL_URL = 'http://http.zhiliandaili.com/Users-whiteIpDelNew.html?appid=2088&appkey=5aef2eeddbab0e25a806f34121c13040&whiteip=';
    const ADD_URL = 'http://http.zhiliandaili.com/Users-whiteIpAddNew.html?appid=2088&appkey=5aef2eeddbab0e25a806f34121c13040&whiteip=';

    public function __construct(BrushService $brushService)
    {
        $this->brushService = $brushService;
    }

    /**
     * 获取ip
     */
    public function getip()
    {
        $ip = $this->get_ip();
        echo $ip;
        die;
    }

    /**
     * 获取关键词
     */
    public function getKeywords()
    {
        $keywords = ["短时强僵尸出没", "秦俊杰杨紫分手", "冲绳7万人集会", "搬家给差评遭报复", "教科书式老赖刑满", "蒙古国列车脱轨", "本田圭佑出任主帅", "男童卖冰棍买手表", "杀害情夫女子归案", "伊朗试射弹道导弹", "郑嘉颖陈凯琳结婚", "答题卡未被调包", "杭州绕城高速事故", "皇马3-1米兰", "山体崩塌前10分", "辽宁将召回高诗岩", "浦东机场坠亡辟谣", "青州发生车祸", "台风蓝色预警", "美大豆船靠港卸货", "鲁能3球员被三停", "奈保尔逝世", "曼彻斯特发生枪击", "秦俊杰工作室声明", "日偏食", "无证德牧咬伤少年", "谢霆锋旧照曝光", "泰达权健共用球场", "林更新否认已婚", "阿联酋足协致歉", "不罚登巴巴吴金贵", "诺奖得主 崔各庄", "抵制天价片酬声明", "千岛群岛发生地震", "南海6次警告美军", "滴滴司机曝光外挂", "克拉克森 亚运会", "陕西球迷围堵大巴", "西雅图飞机被盗", "误发黄海沉船消息", "男童商场扶梯坠下", "美国航空整改信息", "渣渣辉形象被盗用", "拼车拼到两条大狗", "切尔西开门红", "房山山体塌方", "日本议员入境被拒", "英军工厂爆炸", "准大学生划伤豪车", "顺风车加价起冲突", "中国新说唱", "鹿晗退出节目录制", "网红沙滩再发事故", "拼车拼到两条大狗", "人工智能", "王东明", "红旗l5", "毒狗药异烟肼", "卫生纸制馒头", "渣渣辉形象被盗用", "詹姆斯当教育部长", "张艺谋谈奥运假唱", "两分钟空降仨鸡蛋", "网购玩具枪案再审", "黑龙江炭疽疫情", "5900条假睫毛", "水立方将变冰立方", "台风路径实时发布系统", "黄海重大军事活动", "吻戏鉴定师", "中超", "空降排总成绩第二", "澳门赌场", "泰国和尚炫富被判", "英超直播", "海鲜哥救溺水女孩", "记者暗访走私冻肉", "加拿大枪击事件", "转让女儿救儿子", "卖麋鹿肉老板被拘", "风车动漫", "全国企业信用信息公示系统", "首张区块链发票", "若风自曝恋情", "龙目岛被地震抬高", "农村淘宝", "王思聪调侃杨超越", "人民币对美元汇率", "逼十岁女儿写作文", "437人上班时被抓", "玩扭扭车遭碾死", "吉林孙艳军被公诉", "拜仁20-2", "电商卖家自曝刷单", "高分拒绝清华北大", "清北本科落户争议", "中超积分榜", "十天前的外卖", "葛优躺侵权案二审", "马思纯欧豪分手", "高分拒绝清华北大", "拼车拼到两条大狗", "无人机刺杀总统案", "马高潮执行死刑", "女子曝光霸王家规", "张馨予宣布结婚", "渣渣辉形象被盗用", "大连海参被热死", "网红杀鱼弟自杀", "玩扭扭车遭碾死", "卢凯彤坠楼身亡", "邱淑贞看病被偶遇", "献血疼成表情包", "医生交接失误", "王思聪调侃杨超越", "星巴克 比特币", "拜仁20-2", "爱情公寓 盗墓片", "吴卓林被曝卖垃圾", "韩女性抗议偷拍", "马思纯欧豪分手", "清北本科落户争议", "网友向刘翔道歉", "马蓉发声明", "卫生纸制馒头", "杀妻藏尸案再开庭", "贾跃亭财产被冻结", "鹿晗退出节目录制", "十天前的外卖", "张艺谋谈奥运假唱", "中国学生被赶下机", "贷7000元还36万", "网红沙滩再发事故", "马思纯给鸭子扇风", "大陆将向金门供水", "抵制天价片酬声明", "支付宝上线拼团", "庆丰包子铺混改", "437人上班时被抓", "葛优躺侵权案二审", "吻戏鉴定师", "转让女儿救儿子", "华为回应退出美国", "摩拜女员工举报", "爱情公寓回应退票", "女孩直播割腕", "埃及新狮身人面像", "诺奖得主 崔各庄", "新型塑料袋溶于水", "滴滴司机曝光外挂", "网红沙滩再发事故", "拼车拼到两条大狗", "人工智能", "王东明", "红旗l5", "毒狗药异烟肼", "卫生纸制馒头", "詹姆斯当教育部长", "两分钟空降仨鸡蛋", "网购玩具枪案再审", "黑龙江炭疽疫情", "5900条假睫毛", "台风路径实时发布系统", "黄海重大军事活动", "吻戏鉴定师", "空降排总成绩第二", "澳门赌场", "泰国和尚炫富被判", "海鲜哥救溺水女孩", "记者暗访走私冻肉", "加拿大枪击事件", "转让女儿救儿子", "卖麋鹿肉老板被拘", "全国企业信用信息公示系统", "首张区块链发票", "龙目岛被地震抬高", "农村淘宝", "人民币对美元汇率", "逼十岁女儿写作文", "437人上班时被抓", "玩扭扭车遭碾死", "吉林孙艳军被公诉", "电商卖家自曝刷单", "高分拒绝清华北大", "清北本科落户争议", "十天前的外卖", "中秋节", "女子曝光霸王家规", "马高潮执行死刑", "鸿运国际", "百度指数", "印度威胁苹果封网", "英仙座流星雨", "香港挂牌", "美金对人民币的汇率", "大连海参被热死", "女孩直播割腕", "9斤螃蟹收900元", "人民币汇率", "无人机刺杀总统案"];

        echo array_random($keywords, 1)[0];
    }

    /**
     * 获取所有链接
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAllUrls()
    {
        $urls = $this->brushService->getUrls();
        return $this->success('success', view('brush.all_urls', compact('urls'))->render());
    }

    /**
     * 更新链接状态
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUrlStatus()
    {
        $id = request('id', 0);
        $status = request('status', 0);
        $this->brushService->updateUrl($id, ['status' => $status]);
        return $this->success('success');
    }

    /**
     * 任务列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTaskList()
    {
        $tasks = $this->brushService->getTaskList();
        return view('brush.list_task', compact('tasks'));
    }

    /**
     * 添加任务
     */
    public function addTask()
    {
        if (request()->isMethod('post')) {
            $params = request()->all();
            try {
                $this->brushService->addTask($params);
            } catch (Exception $exception) {
                if ($exception->getCode() == 1003) {
                    return $this->error($exception->getMessage());
                }
                return $this->error('添加失败');
            }
            return $this->success('添加成功');
        }
        return view('brush.add_task');
    }

    /**
     * 删除任务
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTask()
    {
        $id = request('id');
        try {
            $this->brushService->deleteTask($id);
        } catch (Exception $exception) {
            return $this->error('删除失败');
        }
        return $this->success('删除成功');
    }

    /**
     * 申请任务
     */
    public function applyTask()
    {
        $group = request('group', 'group1');
        $oldIp = Cache::get($group);
        $ip = $this->getClientIp();
        if ($oldIp) {
            if ($oldIp != $ip) {
                Cache::forever($group, $ip);
                $delUrl = self::DEL_URL.$oldIp;
                file_get_contents($delUrl);
                $addUrl = self::ADD_URL.$ip;
                file_get_contents($addUrl);
            }
        } else {
            $addUrl = self::ADD_URL.$ip;
            file_get_contents($addUrl);
            Cache::forever($group, $ip);
        }
        $map[] = ['status', 1];
        $map[] = ['group', $group];
        $urls = $this->brushService->getUrls($map);
        $task = $this->brushService->getTodayTask($group);
        if (empty($task)) {
            return $this->error('未找到任务');
        } else {
            $hour = intval(date('H'));
            $num = $this->brushService->getTaskHourNum($task->id, $hour);
            $avgSeconds = 3600 / $num;
            $useSecond = mt_rand(0, $avgSeconds * 2);
            $proxy = $this->brushService->getProxy();
            $proxy['ExpireTimeStramp'] = strtotime($proxy['ExpireTime']);
            if (false == $proxy) {
                return $this->error('无法获取代理');
            }
            $this->brushService->setTaskProgress($task->id, $hour, $proxy['IP'], $proxy['Port'], $useSecond);
            return $this->success('success', [
                'urls'    => $urls->toArray(),
                'time'    => time() + $useSecond,
                'enddate' => date('Y-m-d H:i:s', time() + $useSecond),
                'seconds' => $useSecond,
                'proxy'   => $proxy
            ]);
        }
    }

    /**
     * 任务详情
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTaskInfo()
    {
        $id = request('id', 0);
        $taskInfo = $this->brushService->getTaskInfo($id);
        return view('brush.info_task', compact('taskInfo'));
    }

    /**
     * 任务小时详情
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHourInfo()
    {
        $taskId = request('taskId');
        $hour = request('hour');
        $hourInfo = $this->brushService->getHourInfo($taskId, $hour);
        return view('brush.info_hour', compact('hourInfo'));
    }

    /**
     * 获取客户端IP
     * @return bool
     */
    private function getClientIp()
    {
        $ip = false;
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) {
                array_unshift($ips, $ip);
                $ip = FALSE;
            }
            for ($i = 0; $i < count($ips); $i++) {
                if (!preg_match('/^(10│172.16│192.168)./', $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }

    /**
     * 获取headers
     * @return array
     */
    private function getAllHeaders()
    {
        // 忽略获取的header数据。这个函数后面会用到。主要是起过滤作用
        $ignore = array('host', 'accept', 'content-length', 'content-type');

        $headers = array();
        //这里大家有兴趣的话，可以打印一下。会出来很多的header头信息。咱们想要的部分，都是‘http_'开头的。所以下面会进行过滤输出。
        /*    var_dump($_SERVER);
            exit;*/

        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                //这里取到的都是'http_'开头的数据。
                //前去开头的前5位
                $key = substr($key, 5);
                //把$key中的'_'下划线都替换为空字符串
                $key = str_replace('_', ' ', $key);
                //再把$key中的空字符串替换成‘-’
                $key = str_replace(' ', '-', $key);
                //把$key中的所有字符转换为小写
                $key = strtolower($key);

                //这里主要是过滤上面写的$ignore数组中的数据
                if (!in_array($key, $ignore)) {
                    $headers[$key] = $value;
                }
            }
        }
        //输出获取到的header
        return $headers;
    }
}