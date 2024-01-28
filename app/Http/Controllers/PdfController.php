<?php

namespace App\Http\Controllers;

use App\Models\Marchandise;
use Illuminate\Http\Request;
use PDF;
class PdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function generatePDF()
    {

        $marchandises = Marchandise::all();

        // Chargez la vue PDF
        $pdf = PDF::loadView('marchandises.pdf', ['marchandises' => $marchandises]);

        // Téléchargez le PDF
        return $pdf->download('List of goods.pdf');
    }
}
