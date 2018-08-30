<?php

/**
 * 客服登陆
 * 
 * @author: honglinzi
 * @version: 1.0
 */

namespace app\client\controller;

use think\Controller;
use app\api\model\Clerk;

class Login extends Controller
{

    /**
     * 登陆页面
     * 
     * @return string
     */
    public function index()
    {
        return $this->fetch('Login/index');
    }

    /**
     * 管理员登陆
     * 
     * @return string
     */
    public function doLogin()
    {
        $data = $this->request->post();

        $rules = [
            'username|用户名' => 'require|min:2',
            'password|密码' => 'require|length:4,12'
        ];
        $res = $this->validate($data, $rules);

        if (1 == $res)
        {
            $model = new Clerk();

            $clerk = $model->where(['username' => $data['username'], 'password' => md5($data['password'])])->find();

            if ($clerk)
            {
                session('id', $clerk->id);
                session('username', $clerk->username);
                return $this->redirect('/client/Clerk/index');
            }
            else
            {
                return $this->error('登陆失败！');
            }
        }
        else
        {
            return $this->error('登陆失败！' . $res);
        }
    }

    /*
     * 注销
     * 
     * @return string
     */

    public function logout()
    {
        session('id', null);
        session('username', null);
        return $this->redirect('/client/Login/index');
    }

}
