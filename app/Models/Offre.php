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
    protected $primaryKey = 'offre_id'; 
    public $incrementing = true;
    protected $fillable = [
        'offre_id',
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
        return $this->hasMany(Application::class, 'offre_id', 'offre_id');
    }
    // un offre creer par un utilisateur de role admin 
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class, 'creer_par', 'utilisateur_id');
    }
    
}
