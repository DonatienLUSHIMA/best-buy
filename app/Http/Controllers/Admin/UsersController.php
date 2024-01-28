<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marchandise;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();

        // Logique pour obtenir le nombre d'articles dans le panier
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);

        return view('admin.users.index', ['users' => $users, 'nombreArticlesDansPanier' => $nombreArticlesDansPanier]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles=Role::all();
        return view('admin.users.edit',[
            'user'=>$user,
            'roles'=>$roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        $users = User::find($id);

        if (!$users) {
            return response()->json(['error' => 'utilisateur n\'existe pas.'], 404);
        }

        $users->delete();

        return redirect('admin.users.index')->with('success', 'User deleted successfully');
    }*/
     public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect()->route('admin.users.index');
        }
        $user->roles()->detach();
        $user->delete();
      return redirect()->route('admin.users.index');


    }
    public function goodsavailable()
    {
        // Obtenez les marchandises disponibles
        $marchandises = Marchandise::where('disponible', true)->get();

        // Obtenez le nombre d'articles dans le panier depuis la session
        $paniers = Session::get('paniers', []);
        $nombreArticlesDansPanier = count($paniers);

        // Passez les données à la vue
        return view('/admin/users/index', compact('marchandises', 'nombreArticlesDansPanier'));
    }



}
