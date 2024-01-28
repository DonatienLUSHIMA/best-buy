<?php

namespace App\Http\Controllers;

use App\Models\Marchandise;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Assuming Marchandise is an Eloquent model
$marchandises = Marchandise::paginate(8);
return view('home', ['marchandises' => $marchandises]);

    }

public function goodsavailable()
{
    // Obtenez les marchandises disponibles
    $marchandises = Marchandise::where('disponible', true)->get();

    // Obtenez le nombre d'articles dans le panier depuis la session
    $nombreArticlesDansPanier = count(Session::get('paniers', []));


    // Passez les données à la vue
    return view('/home', compact('marchandises', 'nombreArticlesDansPanier'));
}
    public function app()
    {
        return view('/layouts/app');
    }

}
