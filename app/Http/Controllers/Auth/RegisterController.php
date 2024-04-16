<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_photo' => ['image', 'mimes:jpeg,png,jpg,gif'], // Validation de la photo de profil
        ], [
            
        ]);
    }

    protected function create(array $data)
    {
        $profile_photo_path = null;

        if (isset($data['profile_photo']) && $data['profile_photo']->isValid()) {
            $profile_photo_path = $data['profile_photo']->store('users-avatar');
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_photo_path' => $profile_photo_path,
        ]);

        // Enregistrement du rôle de l'utilisateur
        $role = Role::where('name', 'user')->first();
        $user->roles()->attach($role);

        return $user;
    }


    protected function registered(Request $request, $user)
    {
        // Vous pouvez ajouter des actions supplémentaires après l'inscription de l'utilisateur si nécessaire
    }
}
