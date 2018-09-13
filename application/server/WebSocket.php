<?php

/**
 * websocket服务端
 * 
 * @author: honglinzi
 * @version: 1.0
 */
class WebSocket
{

    const HOST = '0.0.0.0';
    const PORT = '9501';
    //离线消息队列
    const MESSAGE_QUEUE = 'message';
    //离线消息队列
    const OFFLINE_QUEUE = 'offlineMessage';
    //在线的客服队列
    const CLERK_QUEUE = 'clerk';
    //在线的访客队列
    const VISITOR_QUEUE = 'visitor';
    //5分钟无任何会话，自动过期
    const EXPIRES = 300;
    //最大任务数
    const TASK_NUM = 10;
    //api地址
    const API_URL = 'http://www.oim.com/api/';

    //webSocket连接对象
    public $server = null;

    public function __construct()
    {
        $redis = new \Redis();
        $redis->pconnect('127.0.0.1', '6379', 0);

        //清空数据
        $redis->flushDB();


        $this->server = new swoole_websocket_server(self::HOST, self::PORT);
        $this->server->redis = $redis;
        $this->server->set([
            //启动task必须要设置其数量
            'task_worker_num' => self::TASK_NUM,
                //心跳检测间隔 跳3下也就是30s无反应就认为死了
               //  'heartbeat_check_interval' => 10,
                //最大闲置时间 30s
               //  'heartbeat_idle_time' => 30,
        ]);
        $this->server->on('open', [$this, 'onOpen']);
        $this->server->on('message', [$this, 'onMessage']);
        $this->server->on('task', [$this, 'onTask']);
        $this->server->on('finish', [$this, 'onFinish']);
        $this->server->on('close', [$this, 'onClose']);
        $this->server->start();
    }

    /**
     * 监听开启事件的回调
     * 
     * @param  $server swoole_websocket_server
     * @param  $request swoole_http_request
     * @return void
     */
    public function onOpen($server, $request)
    {
        if (isset($request->get['id']) && isset($request->get['type']) &&
                in_array($request->get['type'], [self::CLERK_QUEUE, self::VISITOR_QUEUE]))
        {
            $id = intval($request->get['id']);
            $type = $request->get['type'];
            $key = $id . ':' . $type;
            //加进在线队列，如果 key 已经存在， 则关闭，
            //一个会话可与多个客服或访客聊天，但是不支持一个用户开多个客户端
            if ($id > 0 && !$server->redis->get($key))
            {
                $server->redis->setex($key, self::EXPIRES, $request->fd);
                $server->key = $key;

                //以下为内部调度进程处理
                //处理发送离线消息
                if ($server->redis->hExists(self::OFFLINE_QUEUE, $key))
                {
                    $param = ['emit' => 'offlineMessage', 'key' => $key, 'fd' => $request->fd];
                    $server->task($param);
                }
                //处理发送在线客服上线通知
                if ($type == self::CLERK_QUEUE)
                {
                    $param = ['emit' => 'status', 'key' => $key, 'status' => 'online'];
                    $server->task($param);
                }
            }
            else
            {
                $server->disconnect($request->fd);
            }
        }
        else
        {
            $server->disconnect($request->fd);
        }
    }

    /**
     * 监听接收事件的回调
     * 分发任务执行
     * 
     * @param  $server swoole_websocket_server
     * @param  $frame swoole_websocket_frame
     * @return void
     */
    public function onMessage($server, $frame)
    {

        $data = json_decode($frame->data, true);
        if (isset($data['emit']))
        {
            $data['fd'] = $frame->fd;
            $server->task($data);
        }
    }

    /**
     * 监听关闭事件的回调
     * @param  $server swoole_websocket_server
     * @param  $fd 会话连接ID 
     * @return void
     */
    public function onClose($server, $fd)
    {

        if (isset($server->key))
        {
            //处理发送在线状态消息
            $param = ['emit' => 'status', 'key' => $server->key, 'status' => 'offline'];
            $server->task($param);
        }
    }

    /**
     * 执行任务回调事件
     * 
     * @param  $server swoole_websocket_server
     * @param  $task_id 任务ID，由swoole扩展内自动生成，用于区分不同的任务 
     * @param  $src_worker_id   $task_id和$src_worker_id组合起来才是全局唯一的，不同的worker进程投递的任务ID可能会有相同
     * @param  $data  参数传递
     * @return void
     */
    public function onTask($server, $task_id, $src_worker_id, $data)
    {

        switch ($data['emit'])
        {
            case 'msg':
                $userlist = $server->redis->get($data['from']['key']);
                if (false === strpos($userlist, '|' . $data['to']['key']))
                {
                    $userlist = $server->redis->get($data['from']['key']) . '|' . $data['to']['key'];
                }
                $server->redis->setex($data['from']['key'], self::EXPIRES, $userlist);
                $data['from']['timestamp'] = time() * 1000;

                //判断接收人是否在线
                if ($fd = $server->redis->get($data['to']['key']))
                {
                    $message = ['emit' => 'msg', 'data' => $data['from']];
                    $server->push((int) $fd, json_encode($message));
                }
                else
                {
                    //如果对方离线了，先存放在离线消息队列中
                    $this->saveOfflineMessage($server, $data['to']['key'], $data['from']);
                }
                //保存消息
                $this->saveMessage($server, $data['from']['key'], $data['to']['key'], $data['from']);

                break;
            case 'status'://修改在线状态

                $this->notifyStatus($server, $data['key'], $data['status']);
                break;
            case 'offlineMessage':
                $this->sendOfflineMessage($server, $data['fd'], $data['key']);
                break;
        }
    }

    /**
     * 完成事件回调事件
     * 
     * @param $task_id 	是任务的ID
     * @param $data	参数传递
     * @return void
     */
    public function onFinish($serv, $task_id, $data)
    {
        
    }

    /**
     * 调用外部方法
     * 
     * @param $method 方法
     * @param  $param array 携带的参数
     * @return  string 返回获取的内容
     */
    public function callFunction($method, $param)
    {
        $http = curl_init();
        curl_setopt($http, CURLOPT_URL, self::API_URL . $method);
        curl_setopt($http, CURLOPT_HEADER, 0);
        curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($http, CURLOPT_POST, 1);
        curl_setopt($http, CURLOPT_POSTFIELDS, $param);
        $result = curl_exec($http); //运行curl
        curl_close($http);
        return $result;
    }

    /**
     * 保存消息
     * 
     * @param $fromKey 发送人key
     * @param $toKey 接收人key
     * @param  $data 新消息
     * @return void
     */
    public function saveMessage($server, $fromKey, $toKey, $data)
    {
        $array = [];
        $chatKey = intval($fromKey) > intval($toKey) ? ($fromKey . '|' . $toKey) : ($toKey . '|' . $fromKey);

        if ($message = $server->redis->hGet(self::MESSAGE_QUEUE, $chatKey))
        {
            $array = json_decode($message);
        }
        $array[] = $data;
        $server->redis->hSet(self::MESSAGE_QUEUE, $chatKey, json_encode($array));
    }

    /**
     * 保存离线消息
     * 
     * @param $key 接收者
     * @param  $data 新离线消息
     * @return void
     */
    public function saveOfflineMessage($server, $key, $data)
    {
        $array = [];
        //处理有多条消息，则追加在后面
        if ($offlineMessage = $server->redis->hGet(self::OFFLINE_QUEUE, $key))
        {
            $array = json_decode($offlineMessage);
        }
        $array[] = $data;
        $server->redis->hSet(self::OFFLINE_QUEUE, $key, json_encode($array));
    }

    /**
     * 发送离线消息
     * 
     * @param  $server swoole_websocket_server
     * @param $key 接收者
     * @return void
     */
    public function sendOfflineMessage($server, $fd, $key)
    {
        //如果发现存在离线消息，推送之
        if ($offlineMessage = $server->redis->hGet(self::OFFLINE_QUEUE, $key))
        {
            $queue = json_decode($offlineMessage);
            //至少要存在一条，才发送
            if (isset($queue[0]))
            {
                $message = ['emit' => 'offlineMessage', 'data' => $queue];
                if ($server->push($fd, json_encode($message)))
                {
                    //删除离线消息
                    $server->redis->hDel(self::OFFLINE_QUEUE, $key);
                }
            }
        }
    }

    /**
     * 实现客服上下线通知 广播所有客户端
     * 注意$server->connections会话连接池，需要安装pcre组件的支持，并重新编译swoole才有值
     * 用户会话关闭时保存聊天记录到数据库
     * 
     * @param  $server swoole_websocket_server
     * @param $key 上线的客服KEY
     * @param $status 上线的状态 offline online
     * @return void
     */
    public function notifyStatus($server, $key, $status = 'online')
    {
        if ($server->connections)
        {
            $data = ['emit' => 'status', 'id' => (int) $key, 'status' => $status];
            foreach ($server->connections as $fd)
            {
                $server->push($fd, json_encode($data));
            }
            if ($status == 'offline')
            {
                $value = $server->redis->get($key);
                //字符串型，表明至少曾经勾搭过一个用户
                if (is_string($value))
                {
                    //$key=>$value
                    //形式如：888:clerk=>$fd|1:clerk|2:vicistor|3:visitor……
                    $users = array_shift(explode('|', $value));

                    $message = '';
                    foreach ($users as $toKey)
                    {
                        $chatKey = intval($key) > intval($toKey) ? ($key . '|' . $toKey) : ($toKey . '|' . $key);
                        if ($message = $server->redis->hGet(self::MESSAGE_QUEUE, $chatKey))
                        {
                            $data = ['fromkey' => $key, 'tokey' => $toKey, 'content' => $message];
                            if ($this->callFunction('ChatRecord/save', $data))
                            {
                                $server->redis->hDel(self::MESSAGE_QUEUE, $chatKey);
                            }
                        }
                    }
                }
                $server->redis->del($key);
            }
        }
    }

}

$socket = new WebSocket();
