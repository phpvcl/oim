<?php

/**
 * 访客页面
 * 
 * @author: honglinzi
 * @version: 1.0
 */

namespace app\client\controller;

use think\Controller;

class Visitor extends Controller
{

    /**
     * 访客页面
     * 
     * @return string
     */
    public function index()
    {

        return $this->fetch('Visitor/index');
    }

}
