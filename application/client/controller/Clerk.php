<?php

/**
 * 客服页面
 * 
 * @author: honglinzi
 * @version: 1.0
 */
namespace app\client\controller;

use think\Controller;

class Clerk extends Controller
{
    /**
     * 客服页面
     * 
     * @return string
     */
    public function index()
    {
        if(!session('id')){
            return $this->redirect('/client/Login/index');
        }
        return $this->fetch('Clerk/index');
    }

}
