<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehiculos  extends Model
{
    //
    protected $fillable = ['id','vehi_placa','vehi_color','vehi_marca','vehi_tipo_vehiculo','id_propietario','id_conductor'];

    protected $hidden = [];

    public $timestamps = false;

    protected $table = 'td_vehiculos';

    public function scopeSearch($query, $vehi_placa)
    {
        return $query->where('vehi_placa','LIKE',"%$vehi_placa%");
    }
}
