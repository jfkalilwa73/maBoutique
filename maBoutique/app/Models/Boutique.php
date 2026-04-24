<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    use HasFactory;

    protected $table = 'boutiques';
    protected $primaryKey = 'id_boutique';

    protected $fillable = [
        'id_commercant',
        'nom',
        'description',
    ];

    public function commercant()
    {
        return $this->belongsTo(Utilisateur::class, 'id_commercant', 'id_utilisateur');
    }

    public function vendeurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'boutique_vendeur', 'id_boutique', 'id_vendeur')
            ->withTimestamps();
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'boutiques_produits', 'id_boutique', 'id_produit')
            ->withTimestamps();
    }
}