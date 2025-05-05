<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactTicket extends Model
{
    protected $fillable = [
        'ticket_nr','name','email','subject','message','response','status',
    ];
}
