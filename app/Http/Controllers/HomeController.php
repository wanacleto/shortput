<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $user = 'WAGNER ANACLETO';

        //return Inertia::render('Home/Home');    
        return Inertia::render('Home/Home', [
            'user' => $user
        ]);         
        
    }

    public function about()
    {
        return Inertia::render('Home/About');         
    }

    public function register()
    {
        return Inertia::render('Home/Register');         
    }

    public function registerStore(Request $request)
    {
        

        $data = $request->all();
        $validacao = \Validator::make($data,[
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required', 'min:5'],
        ]);      
        
       
        if($validacao->fails()){
          return redirect()->back()->withErrors($validacao)->withInput();
        }
        //$request->password = bcrypt($request->password);        
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->name,
        //     'password' => bcrypt($request->password),
        // ]);
        //dd($request);
        //$user = auth()->user();
        //$user->artigos()->create($data);
        //return redirect()->back();
        return Redirect::route('home')->with('success', 'Usuario criado com sucesso!');


    }


}
