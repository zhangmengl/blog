<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xinwen extends Model
{
    //指定表名
    protected $table = 'xinwen';
    //指定主键  id
    protected $primaryKey = 'xinwen_id';
    //时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded=[];
}
