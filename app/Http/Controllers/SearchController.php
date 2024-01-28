<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marchandise;
use App\Models\SentEmail;
use App\Models\User;

class SearchController extends Controller
{
     public function __construct(){
    $this->middleware('auth');
}
    public function index(Request $request)
    {

        $marchandises = Marchandise::all();
        return view('marchandises.printlist', ['marchandises' => $marchandises]);
        $query = $request->input('query');

        if ($query) {
            $results = Marchandise::where('name', 'LIKE', "%$query%")->get();
        } else {
            $results = Marchandise::all();
        }

        return view('marchandises.index', compact('results'));
    }

    public function searchs_messages(){
        request()->validate([
        ]);
        $Search= request()->input('Search');

        $sent_mails=SentEmail::where('recipient','like',"%$Search%")
                 ->orwhere('subject','like',"%$Search%")
                 ->paginate(0);
                 return view('forms.show-message')->with('sent_mails',$sent_mails);
    }

    public function search(){
    request()->validate([
        'Search'=>'required'
    ]);
    $Search= request()->input('Search');

    $marchandises=Marchandise::where('name','like',"%$Search%")
             ->orwhere('category','like',"%$Search%")
             ->paginate(0);
             return view('marchandises.index')->with('marchandises',$marchandises);
}
public function search_users(){
    request()->validate([
        'Search'=>'required'
    ]);
    $Search= request()->input('Search');

    $users=User::where('name','like',"%$Search%")
             ->orwhere('email','like',"%$Search%")
             ->paginate(0);
             return view('users.user')->with('users',$users);
}
}

