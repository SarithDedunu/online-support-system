<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'subject',
        'description',
        'ref',
        'status',
        'assigned_to',
    ];

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}