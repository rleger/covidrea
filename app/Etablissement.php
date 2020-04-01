<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Etablissement extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * Guarded properties.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * L'établissement a un seul utilisateur de REFERENCE.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * L'établissement a un seul prospect de REFERENCE (potentiellement aucun).
     */
    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    /**
     * Un établissement a plusieurs services.
     */
    public function service()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Scope is within distance (km).
     *
     * @param mixed $query
     * @param array $coordinates
     * @param int   $radius
     */
    public function scopeIsWithinMaxDistance($query, $coordinates, $radius = 5)
    {
        // $haversine = "(6371 * acos(cos(radians(" . $coordinates['lat'] . "))
        // $haversine = '( 111.045 * acos( cos( radians('.$coordinates['lat'].') )
        $haversine = '( 6371 * acos( cos( radians('.$coordinates['lat'].') )
            * cos(radians(etablissements.lat))
            * cos(radians(etablissements.long)
            - radians('.$coordinates['long'].'))
            + sin(radians('.$coordinates['lat'].'))
            * sin(radians(etablissements.lat))))';

        return $query->selectRaw("{$haversine} AS distance")
                     ->whereRaw("{$haversine} < ?", [$radius]);
    }
}
