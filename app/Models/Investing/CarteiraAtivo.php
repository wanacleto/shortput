<?php

namespace App\Models\Investing;

use Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CarteiraAtivo extends Model
{
    protected $table = 'investing.carteira_ativos';
    protected $primaryKey = 'id';
    protected $fillable = [ 'carteira_id', 'carteira_papeis_id', 'calendario_id', 'estrategia_id', 'nome_papel', 'nome_carteira', 'nome_calendario', 'data_compra', 'data_venda', 'valor_papel', 'valor_entrada', 'valor_medio', 'valor_saida', 'valor_final', 'valor_strike', 'valor_total', 'valor_garantia', 'taxa_inicial', 'taxa_final', 'taxa_ir', 'rentabilidde', 'quantidade', 'codigo', 'nota', 'garantia', 'lucro', 'ir', 'status', 'user_id' ];

    
    public function getValorFinalAttribute()    
    {  
        
        $x = $this->attributes['valor_entrada'];
        $y = $this->attributes['valor_saida'];
        $a = $x - $y;      
        $a = number_format($a, 2, '.', '');
        return $a; 
    }

    public function setValorFinalAttribute($value)
    {
        $x = $this->attributes['valor_entrada'];
        $y = $this->attributes['valor_saida'];
        $a = $x - $y;      
        $a = number_format($a, 2, '.', '');
        $this->attributes['valor_final'] = $a;
    }


    public function getValorTotalAttribute()    
    {  
        
        if($this->id){
              
            $x = $this->attributes['valor_entrada'];
            $y = $this->attributes['valor_saida'];
            $a = $x - $y;      
            $b = $a * $this->attributes['quantidade'];
            $b = number_format($b, 2, '.', '');
            return $b;       
            
        }else{
                         
        }        
       
    }

    public function setValorTotalAttribute($value)
    {
        $x = $this->attributes['valor_entrada'];
        $y = $this->attributes['valor_saida'];
        $a = $x - $y;      
        $b = $a * $this->attributes['quantidade'];
        $b = number_format($b, 2, '.', '');
        $this->attributes['valor_total'] = $b; 
    }

    public function getValorGarantiaAttribute()    
    {  
        if($this->id){
              
            $x = $this->attributes['valor_strike'];
            $y = $this->attributes['quantidade'];
            $a = $x * $y;      
            $a = number_format($a, 2, '.', '');
            return $a; 
            
        }else{
                         
        }       
        
    }

    public function setValorGarantiaAttribute($value)
    {
        $x = $this->attributes['valor_strike'];
        $y = $this->attributes['quantidade'];
        $a = $x * $y;  
        $a = number_format($a, 2, '.', '');            
        $this->attributes['valor_garantia'] = $a; 
    }

    public function getTaxaInicialAttribute()    
    {  
        
        $x = $this->attributes['valor_strike'];
        $y = $this->attributes['valor_entrada'];
        $a = ($y / $x)*100;      
 
        return number_format($a, 2, '.', '');
    }

    public function setTaxaInicialAttribute($value)
    {
        $x = $this->attributes['valor_strike'];
        $y = $this->attributes['valor_entrada'];
        $a = ($y / $x)*100;
        $a = number_format($a, 2, '.', '');      
 
        $this->attributes['taxa_inicial'] = $a;
    }

    public function getTaxaFinalAttribute()    
    {  
        
        $x = $this->attributes['valor_entrada'];
        $y = $this->attributes['valor_saida'];
        $a = $x - $y;    
        $x = $this->attributes['valor_strike'];
        $a = ($a / $x)*100;      
 
        return number_format($a, 2, '.', ''); 
    }

    public function setTaxaFinalAttribute($value)
    {
        $x = $this->attributes['valor_entrada'];
        $y = $this->attributes['valor_saida'];
        $a = $x - $y;    
        $x = $this->attributes['valor_strike'];
        $a = ($a / $x)*100;   
        $a = number_format($a, 2, '.', '');    
 
        $this->attributes['taxa_final'] = $a;
    }

    
    // public function getNomePapelAttribute()    
    // {  
        
    //     $papel = Papel::where('id', '=', $this->id)->select('nome')->first();
    //     $nome_papel = $papel->nome;
    //     return $nome_papel; 
    // }

    // public function getNomeCarteiraAttribute()    
    // {  
        
    //     $carteira = Carteira::where('id', '=', $this->carteira_id)->select('nome_carteira')->first();
    //     $nome_carteira  = $carteira->nome_carteira;
    //     return $nome_carteira; 
    // }


    public function carteiraPapeisId()
    {
        return $this->belongsTo(CarteiraPapel::class);
    }

    public function carteiraPapeisIdList() 
    {
        
        if($this->carteira_papel_id){
              
            return CarteiraPapel::where('id', '=', $this->carteira_papel_id)->orderBy('created_at')->get();      
            
        }else{

              //$ip = getenv("REMOTE_ADDR");
              $URL_ATUAL= "$_SERVER[REQUEST_URI]";
              $array = explode("/", $URL_ATUAL);       
              $id = $array[3];         
              
              return CarteiraPapel::where('status', '=', 1)->where('carteira_id', '=', $id)->orderBy('created_at')->get();    
                 
        }        
       
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

    public function calendarioId()
    {
        return $this->belongsTo(Calendario::class);
    }

    public function calendarioIdList(){                 
       
        if($this->calendario_id){
              
            return Calendario::where('id', '=', $this->calendario_id)->orderBy('created_at')->get();      
            
        }else{

            return Calendario::where('status', '=', 1)->orderBy('created_at')->get();   

        }      

       
      
    }

    public function estrategiaId()
    {
        return $this->belongsTo(Estrategia::class);
    }

    public function userId(){        
        
        return $this->belongsTo(User::class);
      
    }
 
    public function userIdList(){                 
       
        return User::where('id', '=', Auth::user()->id)->orderBy('name')->get();   
      
    }

}
