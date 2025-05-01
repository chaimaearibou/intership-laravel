<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Utilisateur extends Model
{
    /** @use HasFactory<\Database\Factories\UtilisateurFactory> */
    use HasFactory;
    protected $primaryKey = 'utilisateur_id'; 
    public $incrementing = true;
    protected $fillable = [
        'utilisateur_id',
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'role',
    ];

    // un utilisateur de role admin ou intern recevoir plusieur notification
    public function Notification(): HasMany
    {
        return $this->hasMany(Notification::class, 'utilisateur_id', 'utilisateur_id');
    }
    // un utilisateur  de role interne a un seule candidate profile
    public function candidat_profile(): HasOne
    {
        return $this->hasOne(Candidat_profile::class, 'utilisateur_id', 'utilisateur_id');
    }
    // un utilisateur de role admin peut gerrer plusieur application
   public function apllication(): HasMany
    {
        return $this->hasMany(Application::class, 'utilisateur_id', 'utilisateur_id');
    }
    // un utilisateur de role admin peut gerrer plusieur offre
   public function offre(): HasMany
    {
        return $this->hasMany(Offre::class, 'creer_par', 'utilisateur_id');
    }

    //? return $this->hasOne(Phone::class, 'foreign_key', 'local_key');
}
