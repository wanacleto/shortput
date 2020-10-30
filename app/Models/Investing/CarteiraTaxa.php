<?php

namespace App\Models\Investing;

use Illuminate\Database\Eloquent\Model;

class CarteiraTaxa extends Model
{
    protected $table = 'investing.carteira_taxas';
    protected $primaryKey = 'id';

    protected $fillable = [ 'carteira_id', 'data_pregao', 'taxa_liquidacao', 'taxa_registro', 'taxa_termo', 'taxa_ana', 'emolumentos', 'taxa_operacional', 'execucao', 'taxa_custodia', 'impostos', 'irrf', 'outros', 'taxa_total', 'nota', 'status'];


    public function getTaxaTotalAttribute()    
    {  
        if($this->id){
              
            $a = $this->attributes['taxa_liquidacao'];
            $b = $this->attributes['taxa_registro'];
            $c = $this->attributes['emolumentos'];
            
            $x = $a + $b + $c;      
            $x = number_format($x, 2, '.', '');
            return $x; 
            
        }else{
                         
        }    
        
    }

    public function setTaxaTotalAttribute($value)    
    {  
        if($this->id){
              
            $a = $this->attributes['taxa_liquidacao'];
            $b = $this->attributes['taxa_registro'];
            $c = $this->attributes['emolumentos'];            
            $x = $a + $b + $c;      
            $x = number_format($x, 2, '.', '');
            return $x; 
            
        }else{
                         
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

}
