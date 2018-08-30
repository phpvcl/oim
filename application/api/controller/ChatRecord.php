<?php
/**
 * 聊天记录接口
 * 
 * @author: honglinzi
 * @version: 1.0
 */
namespace app\api\controller;

use think\Controller;
use app\api\model\ChatRecord as MyModel;

class ChatRecord extends Controller
{
     /**
     * 根据KEY，返回聊天记录
     * 
     * @return string
     */
    public function getChatRecord()
    {
        $key = $this->request->param('key');
        $page = $this->request->param('page/d');
        $result = ['code'=>404, 'data'=>[]];

        if ($key)
        {
            $record = new MyModel();
              
            $data = $record->whereOr([['from_key','=',$key],['to_key','=',$key]])
                    ->order('create_time desc')
                    ->limit($page, 1)
                    ->select();

            if(isset($data[0]->content)){

                $result['data'] = json_decode($data[0]->content);
                $result['create_time'] = date('Y-m-d H:i:s', $data[0]->create_time);
                $result['code'] = 200;
            }
         //   print_r($result);
        }
     //   print_r( json_decode($data));
        return json($result);
    }
    
     /**
     * 保存聊天记录
     * 
     * @return string
     */
    public function save()
    {
        $fromKey = $this->request->post('fromkey');
        $toKey = $this->request->post('tokey');
        $content = $this->request->post('content');
        if ($fromKey && $toKey && $content)
        {
            $record = new MyModel();
            $record->from_key = $fromKey;
            $record->to_key = $toKey;
            $record->content = $content;
            $record->create_time = time();
            if ($record->save())
            {
                return 1;
            }
        }
        return 0;
    }

}
