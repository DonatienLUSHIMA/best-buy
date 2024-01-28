<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marchandise extends Model
{
    use HasFactory;
    protected $fillable=['name', 'quantity', 'unit_price','category','add_date', 'fournisseur', 'expiration_date', 'image','disponible'];
    protected $table='marchandises';
    protected $primaryKey='id';

    public function panier(){
        return $this->hasMany(Panier::class, 'mse_id');
    }
     // Relation avec DetailsCommande (un produit peut être inclus dans plusieurs détails de commandes)
     public function detailsCommandes()
     {
         return $this->hasMany(DetailsCommande::class);
     }
}


