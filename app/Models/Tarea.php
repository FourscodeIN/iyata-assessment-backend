<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    // Datos tareas
    protected $fillable = ['titulo', 'descripcion', 'usuario_id'];

    public function usuario()
    {
        // Relación con el usuario 
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}