<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    /** @use HasFactory<\Database\Factories\OffreFactory> */
    use HasFactory;
    protected $fillable = [
        'id_offre',
        'titre',
        'description',
        'localisation',
        'duration',
        'creer_par',
        'creer_at',
        'date_debut',
        'date_fin',
    ];

    // un offre recevoir plusier application 
    public function application(): HasMany
    {
        return $this->hasMany(Application::class, 'id_offre', 'id');
    }
    // un offre creer par un utilisateur de role admin 
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'creer_par', 'id');
    }
    
}
