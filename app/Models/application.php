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
    protected $primaryKey = 'id_application'; 
    public $incrementing = true;
    protected $fillable =[
        'id_application',
        'statut',
        'applied_at'
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
        return $this->belongsTo(Candidat_profile::class, 'candidat_id', 'candidat_id');
    }

}
