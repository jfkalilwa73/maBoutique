<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produits';
    protected $primaryKey = 'id_produit';

    protected $fillable = [
        'id_categorie',
        'nom',
        'description',
        'prix',
        'quantite',
        'photo',
    ];

    protected $casts = [
        'prix' => 'decimal:2',
        'quantite' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie', 'id_categorie');
    }

    public function boutiques()
    {
        return $this->belongsToMany(Boutique::class, 'boutiques_produits', 'id_produit', 'id_boutique')
            ->withTimestamps();
    }

    public function vendeurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'produit_vendeur', 'id_produit', 'id_vendeur')
            ->withTimestamps();
    }
}