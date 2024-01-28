<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\DetailsCommande;
use App\Models\Marchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommandeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    $commandes = Commande::all();

    // Logique pour obtenir le nombre d'articles dans le panier
    $paniers = Session::get('paniers', []);
    $nombreArticlesDansPanier = count($paniers);

    return view('commandes.list-commande', compact('commandes', 'nombreArticlesDansPanier'));
}

    public function detail($id)
{
    $details_commande = DetailsCommande::find($id);

    if (!$details_commande) {
        abort(404, 'details_commande not found');
    }

    return view('/commandes/detail', ['details_commande' => $details_commande]);
}
public function goodsavailable()
    {
        // Obtenez les marchandises disponibles
        $marchandises = Marchandise::where('disponible', true)->get();

        // Obtenez le nombre d'articles dans le panier depuis la session
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);

        // Passez les données à la vue
        return view('commandes.list-commande', compact('commandes', 'nombreArticlesDansPanier'));

    }

    public function getCommandeCount()
    {
        $commandeCount = Commande::count();
        return view('admin.commandes.homeadmin', compact('commandeCount'));
    }
}
