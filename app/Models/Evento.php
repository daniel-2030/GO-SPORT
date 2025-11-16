<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Evento
 * 
 * @property int $id_evento
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $foto
 * @property int|null $id_reserva
 * @property int|null $id_deporte
 * 
 * @property Reserva|null $reserva
 * @property Deporte|null $deporte
 * @property Collection|ParticipanteEvento[] $participante_eventos
 *
 * @package App\Models
 */
class Evento extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';
    public $timestamps = false;

    protected $casts = [
        'id_reserva' => 'int',
        'id_deporte' => 'int',
        'id_cancha' => 'int',
        'id_admin' => 'int',
        'precio_inscripcion' => 'float'
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'foto',
        'fecha_inicio',
        'fecha_fin',
        'capacidad_participantes',
        'estado',
        'precio_inscripcion',
        'ubicacion',
        'id_reserva',
        'id_deporte',
        'id_cancha',
        'id_admin'
    ];

    public function reserva() { return $this->belongsTo(Reserva::class, 'id_reserva'); }
    public function deporte() { return $this->belongsTo(Deporte::class, 'id_deporte'); }
    public function cancha() { return $this->belongsTo(Cancha::class, 'id_cancha'); }
    public function admin() { return $this->belongsTo(User::class, 'id_admin'); }
    public function participantes() { return $this->hasMany(ParticipanteEvento::class, 'id_evento'); }
}
