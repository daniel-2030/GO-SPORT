<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablaPosicion extends Model
{
    use HasFactory;

    protected $table = 'tabla_posiciones';
    protected $primaryKey = 'id_posicion';
    protected $fillable = [
        'id_liga', 'id_equipo', 'partidos_jugados', 'partidos_ganados', 'partidos_empatados', 
        'partidos_perdidos', 'goles_favor', 'goles_contra', 'diferencia_goles', 'puntos'
    ];

    public function liga()
    {
        return $this->belongsTo(Liga::class, 'id_liga', 'id_liga');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id_equipo');
    }
}
