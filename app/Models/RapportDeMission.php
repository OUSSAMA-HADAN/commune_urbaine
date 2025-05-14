<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RapportDeMission extends Model
{
    use HasFactory;

    protected $table = 'rapport_mission';

    protected $fillable = [
        'idOrdreMission',
        'user_id',
        'sujet',
        'contenu',
        'dateSoumission',
        'file_path',
    ];

    // Relationship to OrdreMission
    public function ordreMission()
    {
        return $this->belongsTo(OrdreMission::class, 'idOrdreMission');
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}