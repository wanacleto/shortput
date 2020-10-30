<?php

namespace App\Models\Investing;

use Auth;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CarteiraConta extends Model
{
    protected $table = 'investing.carteira_contas';
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

    public function empresaId()
    {
        return $this->belongsTo(Empresa::class);
    }


    public function userId(){        
        
        return $this->belongsTo(User::class);
      
    }
 
    public function userIdList(){                 
       
        return User::where('id', '=', Auth::user()->id)->orderBy('name')->get();   
      
    }

}
