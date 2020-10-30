<?php


namespace App\Models\Investing;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'investing.pessoas';
    protected $primaryKey = 'id';
    protected $appends = ['nome_cpf'];
    protected $fillable = [ 
             
        'nome', 'apelido', 'telefone', 'email', 'cpf', 'status'
         
    ];


    public function getResults($data, $totalPage)
    {
        if(!isset($data['filter']) &&  !isset($data['nome']) && !isset($data['cpf']) ){
            return $this->orderBy('id', 'desc')->paginate($totalPage);
        }     

        //$results = no final colocar ->toSql();
        return $this->where(function ($query) use ($data){
            if(isset($data['filter'])){
                $filter = $data['filter'];
                $query->where('nome', 'LIKE', "%{$filter}%");
                $query->orWhere('cpf', 'LIKE', "%{$filter}%");
                $query->orWhere('id', $filter);
            }
            if(isset($data['nome'])){               
                $query->where('nome', 'LIKE', "%{$data['nome']}%" );             
            }
            if(isset($data['cpf'])){   
                $cpf = $data['cpf'] ;          
                $query->where('cpf',  'LIKE', "%{$cpf}%");             
            }    
        })->orderBy('id', 'desc')->paginate($totalPage);

    }

    
    public function getPessoaNomeCpfAttribute()    
    {          
        return "{$this->cpf} - {$this->nome}"; 
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = strtoupper($value);
    }

    public function userId(){        
        
        return $this->belongsTo(User::class);
      
    }
 
    public function userIdList(){                 
       
        return User::where('id', '=', Auth::user()->id)->orderBy('name')->get();   
      
    }


 
}
