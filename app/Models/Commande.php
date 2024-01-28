<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['date_commande'];

    // Relation avec Client (une commande appartient à un client)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec DetailsCommande (une commande peut avoir plusieurs détails de commandes)
    public function detailsCommandes()
    {
        return $this->hasMany(DetailsCommande::class);
    }
}
