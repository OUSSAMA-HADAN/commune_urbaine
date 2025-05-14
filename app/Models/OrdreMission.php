<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrdreMission extends Model
{
    use HasFactory;

    protected $table = 'ordre_mission';

    protected $fillable = [
        'dateDebut',
        'dateAriver',
        'dateFin',
        'transport',
        'destination',
        'objectif',
        'idFonctionnaire',
        'etatRemboursement',
        'file_path',
        'montantRemboursement', 
        'commentairesRemboursement' 
    ];

    // Define the relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'idFonctionnaire');
    }

    // Add this relationship to connect with RapportDeMission
    public function rapport()
    {
        return $this->hasOne(RapportDeMission::class, 'idOrdreMission');
    }
}
