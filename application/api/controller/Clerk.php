<?php
/**
 * 客服接口
 * 
 * @author: honglinzi
 * @version: 1.0
 */
namespace app\api\controller;

use think\Controller;
use app\api\model\Group;
use app\api\model\Clerk as MyModel;

class Clerk extends Controller
{
     /**
     * 获取客服列表
     * 
     * @return string
     */
    public function getList()
    {
        $id = $this->request->param('id/d');
        $model = new Group();
        $data = $model->withAllClerk()->select();
        if ($id && $data)
        {
            $redis = new \Redis();
            $redis->connect('127.0.0.1', '6379');
            foreach ($data as &$list)
            {
                $list->list = $list->clerk;
                unset($list->clerk);
                foreach ($list->list as $key => $clerk)
                {
                    if ($redis->exists($clerk->id . ':' . 'clerk'))
                    {
                        $list->list[$key]['status'] = 'online';
                    }
                }


                //print_r($list);
            }
        }
        $mine = ['username' => 'visitor-'.$id, 'id' => $id, 'usertype' => 'visitor', 'sign' => '电话：8888888', "avatar" => "/pic/00.jpg"];
        $result = ['code' => 0, 'msg' => '', 'data' => ['mine' => $mine, 'friend' => $data]];

        return json($result);
    }        
     /**
     * 获取客服列表，不包含当前客服
     * 
     * @return string
     */
    public function getClerkList()
    {
        $id = $this->request->param('id');
        $mine = MyModel::get($id);
        $data = [];
        if ($mine)
        {
            $model = new Group();
            $data = $model->withClerk($id)->select();
            if ($data)
            {
                $redis = new \Redis();
                $redis->connect('127.0.0.1', '6379');
                foreach ($data as &$list)
                {
                    $list->list = $list->clerk;
                    unset($list->clerk);
                    foreach ($list->list as $key => $clerk)
                    {
                        if ($redis->exists($clerk->id . ':' . 'clerk'))
                        {
                            $list->list[$key]['status'] = 'online';
                        }
                    }
                }
            }
        }
        $result = ['code' => 0, 'msg' => '', 'data' => ['mine' => $mine, 'friend' => $data]];

        return json($result);
    }

}
