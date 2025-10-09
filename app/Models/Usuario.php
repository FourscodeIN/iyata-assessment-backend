<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; // tokens de Sanctum

class Usuario extends Authenticatable
{
    //Datos usuarios
    use HasApiTokens, HasFactory;

    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'email', 'telefono', 'password']; 
    protected $hidden = ['password']; 
}
