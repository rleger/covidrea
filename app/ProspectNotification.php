<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectNotification extends Model
{
    protected $fillable = ['type', 'name', 'feedback', 'prospect_id'];
}
