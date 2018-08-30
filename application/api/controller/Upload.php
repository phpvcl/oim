<?php

/**
 * 图片上传接口
 * 
 * @author: honglinzi
 * @version: 1.0
 */

namespace app\api\controller;
use think\Controller;


class Upload extends Controller
{

    protected $path = './uploads/';
    //图片大小
    protected $limit = 1000 * 1024;
    //允许上传的图片类型
    protected $allowImageExt = 'jpeg,jpg,png,gif,bmp,ico';
    //允许上传的文件类型
    protected $allowFileExt = 'doc,pdf,zip,rar,txt,psd,xls,xlsl,ppt,docx,';    
    /**
     * 处理图片上传
     * 
     * @return string
     */
    public function image()
    {
        $path = $this->path . 'image/';
        $file = request()->file('file');

        $rs = ['code' => 1, 'msg' => '上传失败', 'data' => ['src' => '']];
        $info = $file->validate(['size' => $this->limit, 'ext' => $this->allowImageExt])->move($path);
        if ($info)
        {
            $rs['code'] = 0;
            $rs['msg'] = '上传成功';
            $rs['data']['src'] = substr($info->getPathName(), 1);
        }
        else
        {
            $rs['msg'] = $file->getError();
        }
        return json($rs);
    }
    /**
     * 处理文件上传
     * 
     * @return string
     */
    public function file()
    {
        $path = $this->path . 'file/';
        $file = request()->file('file');

        $rs = ['code' => 1, 'msg' => '上传失败', 'data' => ['src' => '']];
        $info = $file->validate(['size' => $this->limit, 'ext' => $this->allowFileExt])->move($path);
        if ($info)
        {
            $rs['code'] = 0;
            $rs['msg'] = '上传成功';
            $rs['data']['src'] = substr($info->getPathName(), 1);
        }
        else
        {
            $rs['msg'] = $file->getError();
        }
        return json($rs);
    }

}
