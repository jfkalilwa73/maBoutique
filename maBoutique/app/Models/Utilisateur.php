<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authentificatable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Authentificatable
{
    use HasFactory, HasApiTokens;
    protected $table = 'utilisateurs';
    protected $primarykey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'date_de_naissance',
        'sexe',
        'role',
        'photo',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
    public function boutiques()
    {
        return $this->hasMany(Boutique::class, 'id_commercant', 'id_utilisateur');
    }
    public function boutiquesVendeur()
    {
        return $this->belongsToMany(Boutique::class, 'boutique_vendeur', 'id_vendeur','id_boutique')
            ->withTimestamps();
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'produit_vendeur', 'id_vendeur', 'id_produit')
            ->withTimestamps()
    }
}
