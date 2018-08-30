<?php

/**
 * Group模型
 * 
 * @author: honglinzi
 * @version: 1.0
 */

namespace app\api\model;

use think\Model;

class Group extends Model
{
    public function clerk()
    {
        return $this->hasMany('Clerk', 'group_id');
    }
    public function withAllClerk()
    {
        return $this->with('Clerk');
    }    
    public function withClerk($id)
    {
        return $this->with(['Clerk' => function($query)use($id){
            $query->where('id', '<>', $id);
        }]);
    }    
}
