<?php

namespace App\Http\Controllers;

use App\Models\DetailsCommande;
use App\Models\Marchandise;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
class AchatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $marchandises = Marchandise::all();
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);
        return view("marchandises.index", compact('marchandises','nombreArticlesDansPanier'));
    }
    public function create()
    {
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);
        return view('marchandises.create', compact('nombreArticlesDansPanier'));
    }
    public function store(Request $request)
    {

        $request->validate([


            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation pour le champ image
        ]);

        $marchandise = new Marchandise();
        $marchandise->name = $request->input('name');
        $marchandise->quantity = $request->input('quantity');
        $marchandise->u_price = $request->input('u_price',);
        $marchandise->category = $request->input('category');
        $marchandise->add_date = now();
        $marchandise->fournisseur = $request->input('fournisseur');

        // Gérer le téléchargement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
            $marchandise->image = str_replace('storage/app/public/marchandises', '', $imagePath);
        }


        $marchandise->save();

        return redirect('/marchandises/index')->with('success', 'Sale completed successfully!');
    }

    public function edit(Marchandise $marchandise)
    {
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);
        return view('marchandises.edit', compact('marchandise','nombreArticlesDansPanier'));
    }

    public function update(Request $request, Marchandise $marchandise)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'u_price' => 'required|numeric',
            'category' => 'required',
            'add_date' => 'required|date',
            'fournisseur' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mise à jour des champs de la marchandise
        $marchandise->update([
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'u_price' => $request->input('unit_price'),
            'category' => $request->input('category'),
            'add_date' => $request->input('add_date'),
            'fournisseur' => $request->input('fournisseur'),
        ]);

        // Mise à jour de l'image si une nouvelle image est soumise
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $marchandise->update(['image' => $imagePath]);
        }

        return redirect('/marchandises/index')->with('success', 'Marchandise mise à jour avec succès');
    }
    public function show($id)
    {
        $marchandise = Marchandise::find($id);

        if (!$marchandise) {
            abort(404, 'Marchandise not found');
        }

        return view('marchandise.show', ['marchandise' => $marchandise]);
    }
    public function destroy($id)
    {
        $marchandise = Marchandise::find($id);

        if (!$marchandise) {
            return response()->json(['error' => 'La marchandise n\'existe pas.'], 404);
        }

        $marchandise->delete();

        return redirect('/marchandises/index')->with('success', 'Marchandise supprimée avec succès');
    }

    // public function delete($id)
    // {
    //     $marchandise = Marchandise::find($id);

    //     if (!$marchandise) {
    //         abort(404, 'Marchandise not found');
    //     }

    //     return view('marchandises.delete', ['marchandise' => $marchandise]);
    // }

public function goodsavailable()
{
    // Obtenez les marchandises disponibles
    $marchandises = Marchandise::where('disponible', true)->get();

    // Obtenez le nombre d'articles dans le panier depuis la session
    $paniers = Session::get('paniers', []);
    $nombreArticlesDansPanier = count($paniers);

    // Passez les données à la vue
    return view('/marchandises/displayM', compact('marchandises', 'nombreArticlesDansPanier'));
}

public function detail($id)
{
    $marchandise = Marchandise::find($id);

    if (!$marchandise) {
        abort(404, 'Marchandise not found');
    }

    return view('/marchandises/detail', ['marchandise' => $marchandise]);
}
public function displayPrint(){
    $marchandises = Marchandise::all();
        return view('marchandises.printlist', ['marchandises' => $marchandises]);
}

public function show_commande(){
    $details_commandes = DetailsCommande::all();
    return view('list-commande', compact('details_commandes'));
}

}

