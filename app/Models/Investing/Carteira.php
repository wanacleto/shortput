<?php


namespace App\Models\Investing;

use Auth;
use TCG\Voyager\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Carteira extends Model
{

    use SoftDeletes;

    protected $table = 'investing.carteiras';
    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];
    protected $fillable = [ ];

    public function pessoaId()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function getNomeAttribute()    {  
        
        $pessoa = Pessoa::where('id', '=', $this->pessoa_id)->select('nome')->first();
        $nome_pessoa = $pessoa->nome;

        return $nome_pessoa; 
    }

    public function userId(){     
        return $this->belongsTo(User::class);      
    }
 
    public function userIdList(){                    
        return User::where('id', '=', Auth::user()->id)->orderBy('name')->get();   
    }

    public static function reportA()
    {       
        $carteiras = DB::select("SELECT * FROM investing.carteiras");  
        return $carteiras;
    }

    public static function reportB()
    {       
        return VwCarteira::all(); 
    }

    public static function reportC()
    {       
        return VwCarteiraTotal::all(); 
    }
        
    public static function filterA($request)
    {
       $carteiras =   VwCarteira::where('carteira_id', '=', $request->carteira)->orderBy('status')->orderBy('data_venda')->orderBy('estrategia_id')->orderBy('carteira_papeis_id')->get();    
        return $carteiras;
        
    }

    public static function filterB($request)
    {
       $carteiras =   VwCarteiraTotal::where('carteira_id', '=', $request->carteira)->orderBy('ano_venda')->orderBy('mes_venda')->orderBy('estrategia_id')->get();    
        return $carteiras;
        
    }

    public static function filterC($request)
    {
       $carteiras =   VwCarteiraTaxa::where('carteira_id', '=', $request->carteira)->orderBy('data_pregao')->get();    
        return $carteiras;
        
    }

    public static function filterD($request)
    {
       $carteiras =   VwCarteiraTaxa::where('carteira_id', '=', $request->carteira)->orderBy('data_pregao')->get();    
        return $carteiras;
        
    }


  





}
