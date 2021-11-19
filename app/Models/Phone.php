<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Phone extends Model {

    protected $table = 'phones';

    protected $fillable = ['user_id','number'];
    
    public $timestamps = false;
}