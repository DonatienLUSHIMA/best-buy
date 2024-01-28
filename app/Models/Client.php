<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nom'];

    // Relation avec Commande (un client peut avoir plusieurs commandes)
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
