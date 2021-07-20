<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    
    protected $fillable = [
        //'comentario', 'us_com', 'serpro_id'
        'pregunta', 'respuesta', 'etiqueta_1', 'etiqueta_2'
    ];

}