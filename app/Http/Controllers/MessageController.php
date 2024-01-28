<?php

namespace App\Http\Controllers;

use App\Mail\MessageGoogle;
use App\Models\Marchandise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SentEmail;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
{
    $sent_mails = SentEmail::paginate(8);

    // Logique pour obtenir le nombre d'articles dans le panier
    $paniers = Session::get('paniers', []);
    $nombreArticlesDansPanier = count($paniers);

    return view('forms.show-message', compact('sent_mails', 'nombreArticlesDansPanier'));
}


    public function formMessageGoogle()
    {
        $users = User::all();
        return view("forms.message-google", compact('users'));
    }

    public function sendMessageGoogle(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'recipients' => 'required|array', // 'recipients' doit être un tableau
        ]);

        $recipients = $request->input('recipients');

        // Enregistrez les détails de l'email dans la base de données
        foreach ($recipients as $recipient) {
            SentEmail::create([
                'recipient' => $recipient,
                'subject' => $request->input('title'),
                'body' => $request->input('message'),
            ]);

            // Envoyez l'email à chaque destinataire
            Mail::to($recipient)->bcc("ingenieurdonatien1@gmail.com")
                ->queue(new MessageGoogle($request->all()));
        }

        return back()->withText("Message envoyé avec pièce jointe");
    }

    public function destroy($id)
    {
        $sent_emails = SentEmail::find($id);

        if (!$sent_emails) {
            return response()->json(['error' => 'La marchandise n\'existe pas.'], 404);
        }

        $sent_emails->delete();

        return redirect('/forms/message-google')->with('success', 'Marchandise supprimée avec succès');
    }
    public function searchs_messages()
    {
        request()->validate([
            'Search' => 'required|min:2'
        ]);
        $search = request()->input('Search');

        $sent_mails = SentEmail::where('recipient', 'like', "%$search%")
            ->orWhere('subject', 'like', "%$search%")
            ->paginate(8); // Modifiez ici si nécessaire

        return view('forms.show-message', compact('sent_mails'));
    }
    public function goodsavailable()
    {
        // Obtenez les marchandises disponibles
        $marchandises = Marchandise::where('disponible', true)->get();

        // Obtenez le nombre d'articles dans le panier depuis la session
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);

        // Passez les données à la vue
        return view('/forms/show-message', compact('marchandises', 'nombreArticlesDansPanier'));
    }
}
