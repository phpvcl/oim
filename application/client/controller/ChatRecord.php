<?php
/**
 * 聊天记录
 * 
 * @author: honglinzi
 * @version: 1.0
 */
namespace app\client\controller;
use think\Controller;

class ChatRecord extends Controller
{
    /**
     * 聊天记录页面
     * 
     * @return string
     */
    public function index()
    {

        return $this->fetch('ChatRecord/index');
    }


}
