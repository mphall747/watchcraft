<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    protected $table = 'payments';
    protected $primary_key = 'ticket_id';
}
