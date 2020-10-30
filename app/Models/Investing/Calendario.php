<?php

namespace App\Models\Investing;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'investing.calendarios';
    protected $primaryKey = 'id';
    protected $appends = ['nome_calendario'];

    public function tabelaVencimentoId()
    {
        return $this->belongsTo(TabelaVencimento::class);
    }

}
