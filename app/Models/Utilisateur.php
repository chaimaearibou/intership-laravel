<?php

namespace App\Models;

use App\Models\CandidatProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Utilisateur extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UtilisateurFactory> */
    use HasFactory;
    // use Authenticatable;

    protected $primaryKey = 'utilisateur_id'; 
    public $incrementing = true;
    protected $fillable = [
        'utilisateur_id',
        'nom',
        'prenom',
        'email',
        'password',
        'role',
    ];

     protected $hidden = ['password', 'remember_token'];
    

    // un utilisateur de role admin ou intern recevoir plusieur notification
    public function Notification(): HasMany
    {
        return $this->hasMany(Notification::class, 'utilisateur_id', 'utilisateur_id');
    }
    // un utilisateur  de role interne a un seule candidate profile
    public function candidat_profile(): HasOne
    {
        return $this->hasOne(CandidatProfile::class, 'utilisateur_id', 'utilisateur_id');
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
