<?php

namespace App\Models\Investing;

use Auth;
use TCG\Voyager\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class CarteiraAporte extends Model
{
    protected $table = 'investing.carteira_aportes';
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

    public function carteiraContaId()
    {
        return $this->belongsTo(CarteiraConta::class);
    }

    public function carteiraContaIdList() {
        
        if($this->carteira_conta_id){
              
            return CarteiraConta::where('id', '=', $this->carteira_conta_id)->orderBy('created_at')->get();      
            
        }else{

              //$ip = getenv("REMOTE_ADDR");
              $URL_ATUAL= "$_SERVER[REQUEST_URI]";
              $array = explode("/", $URL_ATUAL);       
              $id = $array[3];         
              
              return CarteiraConta::where('status', '=', 1)->where('id', '=', $id)->orderBy('created_at')->get();    
                 
        }        
       
    }


    public function userId(){        
        
        return $this->belongsTo(User::class);
      
    }
 
    public function userIdList(){                 
       
        return User::where('id', '=', Auth::user()->id)->orderBy('name')->get();   
      
    }

}
