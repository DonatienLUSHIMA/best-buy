<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\DetailsCommande;
use App\Models\Produit;
use App\Models\Marchandise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function panier()
{
    $marchandises = Marchandise::all();
    $paniers = Session::get('paniers', []); // Récupérez les paniers de la session
    $nombreArticlesDansPanier = count($paniers);
    $totalGeneral = Session::get('total_general', 0); // Récupérez le total général de la session

    return view('paniers.panier', compact('marchandises', 'paniers', 'totalGeneral','nombreArticlesDansPanier'));
}


    public function ajouterPanier($id)
    {
        $marchandise = Marchandise::find($id);
        return view("paniers.ajouterPanier", [
            "marchandise"=> $marchandise
        ]);
    }

    public function savePanier(Request $request, $id)
{
    $marchandise = Marchandise::find($id);

    if ($marchandise == null) {
        // Traitez le cas où la marchandise n'est pas trouvée
    }

    $quantite = $request->input('quantite');
    $global_price = $marchandise->u_price * $quantite; // Calcul du prix global

    $paniers = Session::get('paniers', []);

    // Recherche du produit dans le panier
    $index = array_search($marchandise->id, array_column($paniers, 'marchandise_id'));

    // Si le produit existe, mise à jour de la quantité
    if ($index !== false) {
        $paniers[$index]['quantite'] += $quantite;
    } else {
        // Si le produit n'existe pas, ajout au panier
        $panier = [
            'marchandise_id' => $marchandise->id,
            'marchandise_name' => $marchandise->name,
            'quantite' => $quantite,
            'marchandise_u_price' => $marchandise->u_price,
            'marchandise_image' => $marchandise->image,
            'global_price' => $global_price,
        ];
        $paniers[] = $panier;

        // Recalculer le total général après l'ajout d'un nouveau produit
        $totalGeneral = $this->calculateTotalGeneral($paniers);
        Session::put('total_general', $totalGeneral);
    }

    Session::put('paniers', $paniers);

    return redirect()->route('Paniers.panier');
}

// Fonction pour calculer le total général
private function calculateTotalGeneral($paniers)
{
    $totalGeneral = 0;
    foreach ($paniers as $panier) {
        $totalGeneral += $panier['global_price'];
    }

    return $totalGeneral;
}

public function finaliserCommande()
{
    if (!Auth::check()) {
        // Redirection si l'utilisateur n'est pas connecté
        return redirect()->route('login')->with('error', 'Veuillez vous connecter pour finaliser la commande.');
    }

    // Récupérer l'utilisateur connecté
    $user = Auth::user();
    $paniers = Session::get('paniers', []);

    if (empty($paniers)) {
        // Ajoutez un message ou une redirection appropriée si le panier est vide
    }

    DB::beginTransaction();

    try {
        $commande = new Commande();
        $commande->date_commande = now();
        $commande->user_id = $user->id; // Utilisez l'ID de l'utilisateur connecté
        $commande->save();



        $total_general = 0;

        foreach ($paniers as $panier) {
            $detailsCommande = new DetailsCommande();
            $detailsCommande->commande_id = $commande->id;
            $detailsCommande->marchandise_id = $panier['marchandise_id'];
            $detailsCommande->marchandise_name = $panier['marchandise_name'];
            $detailsCommande->quantite = $panier['quantite'];
            $detailsCommande->marchandise_u_price = $panier['marchandise_u_price'];
            $detailsCommande->marchandise_image = $panier['marchandise_image'];
            $detailsCommande->global_price = $panier['global_price'];
            $detailsCommande->save();

            $total_general += $panier['global_price'];
        }
        $commande->total_general = $total_general;
        DB::commit();

        session()->forget('paniers');

        return redirect()->route('marchandises.displayM')->with('success', 'Commande enregistrée avec succès !')->with('total_general', $total_general);
    } catch (\Exception $e) {
        // Ajouter cette ligne pour voir l'erreur en cas d'échec
        dd('Erreur lors de la création de la commande', $e->getMessage());
        DB::rollBack();
    }
}

public function supprimerMarchandise($marchandise_id)
{
    $paniers = session('paniers', []);

    if (isset($paniers[$marchandise_id])) {
        unset($paniers[$marchandise_id]);
    }
    session()->put('paniers', $paniers);

    return redirect()->route('Paniers.panier');
}

public function destroy($id)
{
    $paniers = Session::get('paniers', []);

    $index = array_search($id, array_column($paniers, 'marchandise_id'));
    if ($index !== null) {
        unset($paniers[$index]);
        Session::put('paniers', $paniers);
        $totalGeneral = $this->calculateTotalGeneral($paniers);
        Session::put('total_general', $totalGeneral);
    }

    return redirect()->route('Paniers.panier');
}

public function goodsavailable()
    {
        // Obtenez les marchandises disponibles
        $marchandises = Marchandise::where('disponible', true)->get();

        // Obtenez le nombre d'articles dans le panier depuis la session
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);

        // Passez les données à la vue
        return view('paniers.panier', compact('marchandises', 'paniers', 'totalGeneral','nombreArticlesDansPanier'));

    }
}
