<?php

namespace App\Wechat;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'area_id';
//    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $guarded = [];
}
