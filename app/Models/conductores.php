<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class conductores extends Model
{
    //
    protected $fillable = ['id','prop_fnombre','prop_Lnombre','prop_apellidos','prop_cedula','prop_direccion','prop_telefono','prop_Ciudad'];

    protected $hidden = [];

    public $timestamps = false;

    protected $table = 'td_conductores';

    public function scopeSearch($query, $prop_cedula)
    {
        return $query->where('prop_cedula','LIKE',"%$prop_cedula%");
    }
}
