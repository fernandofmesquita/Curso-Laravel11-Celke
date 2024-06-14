<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Classe extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    // Indicar o nome da Tabela (opcional se tiver seguindo a regra de pluralidade)
    protected $table = 'classes';

    // Indicar quais colunas podem ser cadastradas 
    protected $fillable = ['name', 'description', 'order_classe', 'course_id'];

    // Criar relacionamento entre um e muitos (FILHO)
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
