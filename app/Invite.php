<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'email', 'token', 'etablissement_id', 'active'
    ];

    public function scopeIsActive($query)
    {
        return $query->where('active', '>', 0);
    }
}
