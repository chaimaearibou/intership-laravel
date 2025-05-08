<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidatProfile extends Model
{
    /** @use HasFactory<\Database\Factories\CandidatProfileFactory> */
    use HasFactory;
    protected $primaryKey = 'candidat_id'; 
    public $incrementing = true;

    protected $fillable =[
        'candidat_id',
        'nom_candidat',
        'prenom_candidat',
        'number',
        'statut',
        'photo'
    ];

    // un candiadat peut faire plusieur application
    public function application(): HasMany{
        return $this->hasMany(Application::class, 'candidat_id', 'candidat_id');
    }
    // un candidat appartient a un utilisateur
    public function utilisateur(): BelongsTo{
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id', 'utilisateur_id');
    }
}
