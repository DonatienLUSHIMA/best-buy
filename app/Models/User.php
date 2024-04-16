<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_photo_path',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
       {
           return $this->belongsToMany('App\Models\Role');
       }
       //function for admin
    public function isAdmin(){
        return $this->roles()->where('name', 'Admin')->exists();
    }
    //Function for admin and auteur
    public function hasAnyRole(array $roles){
        return $this->roles()->whereIn('name', $roles)->exists();
    }
    public function isUser(){
        return $this->roles()->where('name', 'user')->exists();
    }

    // Relation avec Commande (un client peut avoir plusieurs commandes)
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

}
