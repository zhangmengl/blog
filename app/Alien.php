<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alien extends Model
{
    //表名
    protected $table = 'alien';
    //主键
    protected $primaryKey = 'alien_id';
    //时间戳
    public $timestamps = false;
    //黑名单  用create添加的时候加黑名单
    protected $guarded = [];
}
