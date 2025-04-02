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
    ];


    // Define the relationship to Fonctionnaire
    public function User()
    {
        return $this->belongsTo(User::class, 'idFonctionnaire');
    }
}
