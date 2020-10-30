<?php

namespace App\Models\Investing;

use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CarteiraPapel extends Model
{
    use SoftDeletes;

    protected $table = 'investing.carteira_papeis';
    protected $primaryKey = 'id';
    protected $appends = ['nome_papel', 'nome_pessoa'];
    protected $dates = ['deleted_at'];
    protected $fillable = [ ];

    public function getNomePapelAttribute()    {  
        
        $papel = Papel::where('id', '=', $this->papel_id)->select('nome')->first();
        $nome_papel = $papel->nome;

        return $nome_papel; 
    }

    public function getNomePessoaAttribute()    {  
        
        $carteira = Carteira::where('id', '=', $this->carteira_id)->select('pessoa_id')->first();       
        $pessoa = Pessoa::where('id', '=', $carteira->pessoa_id)->select('nome')->first();             
        $nome_carteira = $pessoa->nome;
        return $nome_carteira; 
    }



    public function carteiraId()
    {
        return $this->belongsTo(Carteira::class);
    }

    public function carteiraIdList() {
        
        if($this->carteira_id){
              
            return Carteira::where('id', '=', $this->carteira_id)->orderBy('created_at')->get();      
            
        }else{

              //$ip = getenv("REMOTE_ADDR");
              $URL_ATUAL= "$_SERVER[REQUEST_URI]";
              $array = explode("/", $URL_ATUAL);       
              $id = $array[3];         
              
              return Carteira::where('status', '=', 1)->where('id', '=', $id)->orderBy('created_at')->get();    
     
            
        }        
       
    }

    public function papelId()
    {
        return $this->belongsTo(Papel::class);
    }




}
