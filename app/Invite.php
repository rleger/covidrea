<?php

namespace App;

use URL;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'email', 'rpps', 'token', 'etablissement_id', 'active',
    ];

    public function scopeIsActive($query)
    {
        return $query->where('active', '>', 0);
    }

    /**
     * Temporary signed url.
     *
     * @param mixed $route
     * @param int   $days
     * @param mixed $params
     */
    public function makeTemporarySignedUrl($route, $days = 1, $params = [])
    {
        return URL::temporarySignedRoute(
            $route,
            now()->addDays($days),
            $params
        );
    }
}
