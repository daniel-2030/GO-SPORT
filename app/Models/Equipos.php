<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipos extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';
    protected $fillable = [
        'nombre_equipo',
        'ciudad',
        'fundacion',
        'escudo_url',
        'categoria',
        'estado'
    ];
    public $timestamps = false;

    // Relación con ligas (a través de equipos_liga)
    public function ligas()
    {
        return $this->belongsToMany(Liga::class, 'equipos_liga', 'id_equipo', 'id_liga');
    }

    // Relación con partidos como local
    public function partidosLocal()
    {
        return $this->hasMany(PartidoLiga::class, 'id_equipo_local', 'id_equipo');
    }

    // Relación con partidos como visitante
    public function partidosVisitante()
    {
        return $this->hasMany(PartidoLiga::class, 'id_equipo_visitante', 'id_equipo');
    }

    // Relación con tabla de posiciones
    public function posiciones()
    {
        return $this->hasMany(TablaPosicion::class, 'id_equipo', 'id_equipo');
    }
}