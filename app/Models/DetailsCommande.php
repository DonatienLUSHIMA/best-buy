<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsCommande extends Model
{
    protected $fillable = ['quantite'];

    // Relation avec Produit (un détail de commande appartient à un produit)
    public function marchandise()
    {
        return $this->belongsTo(Marchandise::class);
    }

    // Relation avec Commande (un détail de commande appartient à une commande)
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
