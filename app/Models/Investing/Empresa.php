<?php

namespace App\Models\Investing;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use SoftDeletes;

    protected $table = 'investing.empresas';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    protected $fillable = [ ];

    public function tipoEmpresaId()
    {
        return $this->belongsTo(TipoEmpresa::class);
    }

}
