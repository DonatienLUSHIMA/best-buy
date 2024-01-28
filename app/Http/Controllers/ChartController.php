<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commande;
use App\Models\Marchandise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
{
    // Logic to retrieve chart data
    $marchandiseData = Marchandise::select('name', 'quantity')->get();

    $labels = $marchandiseData->pluck('name');
    $data = $marchandiseData->pluck('quantity');

    // Créer un tableau de couleurs dynamiquement pour chaque marchandise
    $backgroundColor = [];
    $hoverBackgroundColor = [];

    foreach ($marchandiseData as $marchandise) {
        $backgroundColor[] = $this->generateRandomColor();
        $hoverBackgroundColor[] = $this->generateRandomColor();
    }

    $chartData = [
        'labels' => $labels,
        'datasets' => [
            [
                'data' => $data,
                'backgroundColor' => $backgroundColor,
                'hoverBackgroundColor' => $hoverBackgroundColor,
            ],
        ],
    ];

    $userCount = User::count();
    $commandeCount = Commande::count();
    $marchandiseCount = Marchandise::count();

    // Check if the view exists
    if (View::exists('admin.users.homeadmin')) {
        return view('admin.users.homeadmin', compact('chartData', 'userCount', 'marchandiseCount', 'commandeCount'));
    } else {
        // Handle the case where the view does not exist
        abort(404);
    }
}

// Fonction pour générer une couleur aléatoire
private function generateRandomColor()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
}
