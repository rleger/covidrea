<?php

namespace App;

use URL;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Prospect extends Model implements AuditableContract
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    /**
     * Temporary signed url
     *
     * @param mixed $route
     * @param int $days
     * @param mixed $params
     */
    public function makeTemporarySignedUrl($route, $days = 1, $params = [])
    {
        return URL::temporarySignedRoute(
            $route, now()->addDays($days), $params
        );
    }
}
