<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidat_profile extends Model
{
    /** @use HasFactory<\Database\Factories\CandidatProfileFactory> */
    use HasFactory;
    protected $fillable =[
        'id_candidat',
        'nom_candidat',
        'prenom_candidat',
        'statut',
        'number',
        'cv',
        'lettre_motivation',
    ];

    // un candiadat peut faire plusieur application
    public function application(): HasMany{
        return $this->hasMany(Application::class, 'id_candidat', 'id_candidat');
    }
    // un candidat appartient a un utilisateur
    public function utilisateur(): BelongsTo{
        return $this->belongsTo(Utilisateur::class, 'id_candidat', 'id');
    }
}
