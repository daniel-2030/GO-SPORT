<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    use HasFactory;

    protected $table = 'ligas';
    protected $primaryKey = 'id_liga';
    protected $fillable = ['id_temporada', 'nombre', 'descripcion', 'estado'];
    public $timestamps = false;  // 👈 DESACTIVA CREATED_AT Y UPDATED_AT
    
    public function getRouteKeyName()
    {
        return 'id_liga';
    }

    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'id_temporada', 'id_temporada');
    }

    public function equipos() {
        return $this->hasMany(Equipo::class, 'id_liga', 'id_liga');
    }

    public function partidos() {
        return $this->hasMany(PartidoLiga::class, 'id_liga', 'id_liga');
    }


    public function tablaPosiciones()
    {
        return $this->hasMany(Equipoliga::class, 'id_liga');
    }

}
