<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    /**
     * Guarded properties.
     *
     * @var mixed
     */
    protected $guarded = [];

    /**
     * L'établissement a un seul utilisateur de REFERENCE.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
