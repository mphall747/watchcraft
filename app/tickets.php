<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tickets extends Model
{
    protected $table = 'tickets';
    protected $primary_key = 'ticket_id';
}
