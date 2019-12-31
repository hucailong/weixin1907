<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $primaryKey='u_id';
    public $table='user';
    public $timestamps=false;
    //黑名单 表设计中允许为空的
    protected $guarded = [];


}
