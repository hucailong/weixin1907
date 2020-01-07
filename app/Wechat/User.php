<?php

namespace App\Wechat;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $primaryKey='id';
    public $table='user';
    public $timestamps=false;
    //黑名单 表设计中允许为空的
    protected $guarded = [];
}
