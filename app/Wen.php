<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wen extends Model
{
    //指定表名
    protected $table = 'wen';
    //指定主键  id
    protected $primaryKey = 'wen_id';
    //时间戳
    public $timestamps = false;
    //黑名单
    //protected $guarded=[];
}
