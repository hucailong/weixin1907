<?php

namespace App\Wechat;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $primaryKey='report_id';
    public $table='report';
    public $timestamps=false;
    //黑名单 表设计中允许为空的
    protected $guarded = [];
}
