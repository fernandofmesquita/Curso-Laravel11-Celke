<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    
    // Indicar o nome da Tabela (opcional se tiver seguindo a regra de pluralidade)
    protected $table = 'classes';

    // Indicar quais colunas podem ser cadastradas 
    protected $fillable = ['name', 'description', 'course_id'];

}
