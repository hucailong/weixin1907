<?php

namespace App\Wechat;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'media';
//    protected $dateFormat = 'U';
    public $timestamps = false;
    protected $guarded = [];

}
