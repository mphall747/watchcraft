<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'customers';
    protected $primary_key = 'customer_id';
}
