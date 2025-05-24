<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;
    protected $primaryKey = 'notification_id'; 
    public $incrementing = true;

    protected $fillable = [
        'notification_id',
        'message',
        'type',
        'lue',
        'utilisateur_id',
        'application_id',
    ];

    // un utilisateur recevoir plusieur notification
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class,'utilisateur_id', 'utilisateur_id');
    }
    public function getRouteKeyName()
{
    return 'notification_id';
}

}
