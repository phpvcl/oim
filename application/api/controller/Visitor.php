<?php

/**
 * 访客接口
 * 
 * @author: honglinzi
 * @version: 1.0
 */

namespace app\api\controller;

use think\Controller;
use app\api\model\Visitor as MyModel;

class Visitor extends Controller
{

    /**
     * 分配一个新访客ID
     * 
     * @return string
     */
    public function save()
    {
        $id = $this->request->post('id/d');
        $referrer = $this->request->post('referrer');
        $url = $this->request->post('url');
        $ip = $this->request->server('REMOTE_ADDR');
        $userAgent = $this->request->server('HTTP_USER_AGENT');
        $result = ['code' => 404, 'data' => []];

        $model = new MyModel();
        if (!$model->get($id))
        {
            $data = ['referrer'=>$referrer, 'url'=>$url, 'ip'=>  ip2long($ip), 'user_agent'=>$userAgent, 'create_time'=>time()];
            $rs = $model->save($data);
            if ($rs)
            {
                $result['code'] = 200;
                $result['data']['id'] = $model->id;
            }            
        }else{
            $result['code'] = 200;
            $result['data']['id'] = $id;
        }
 
        return json($result);
    }

}
