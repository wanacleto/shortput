<?php

namespace App\Models\Investing;

use Illuminate\Database\Eloquent\Model;

class CarteiraDividendo extends Model
{
    protected $table = 'investing.carteira_dividendos';
    protected $primaryKey = 'id';

    
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
}
