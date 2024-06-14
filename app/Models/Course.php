<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // Indicar o nome da Tabela (opcional se tiver seguindo a regra de pluralidade)
    protected $table = 'courses';

    // Indicar quais colunas podem ser cadastradas 
    protected $fillable = ['name', 'price'];

    // Criar relacionamento entre um e muitos (PAI)
    public function classe()
    {
        return $this->hasMany(Classe::class);
    }

}
