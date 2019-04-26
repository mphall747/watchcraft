<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class completed_tickets extends Model
{
    protected $table = 'completed_tickets';
    protected $primary_key = 'ticket_id';
}
