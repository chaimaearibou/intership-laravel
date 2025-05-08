<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;
    protected $primaryKey = 'application_id'; 
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable =[
        'application_id',   
        'statut',
        'applied_at',
        'cv',
        'lettre_motivation',
    ];

    // *un application peut gerrer par plusieru utilisateur de role admine
    public function utilisateur():BelongsTo{
        return $this->belongsTo(Utilisateur::class,'utilisateur_id', 'utilisateur_id');

    }
    //* un application peut recevoir plusieur offre
    public function offre():BelongsTo{
        return $this->belongsTo(Offre::class,'offre_id', 'offre_id');
    }
    //* un andidat peut faire plusieur application
    public function candidat():BelongsTo{
        return $this->belongsTo(CandidatProfile::class, 'candidat_id', 'candidat_id');
    }

}
