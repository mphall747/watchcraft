<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    protected $table = 'employees';
    protected $primary_key = 'employee_id';
}
