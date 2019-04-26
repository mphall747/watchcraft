<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = 'categories';
    protected $primary_key = 'category_id';
    public $timestamps = false;
}
