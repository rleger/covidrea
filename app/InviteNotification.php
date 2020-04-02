<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InviteNotification extends Model
{
    protected $fillable = ['type', 'name', 'feedback', 'invite_id'];
}
