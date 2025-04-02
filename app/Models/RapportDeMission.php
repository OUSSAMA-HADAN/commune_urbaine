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
        'sujet',
        'contenu',
        'dateSoumission',
        'file_path',
    ];

    // Define the relationship to OrdreMission
    public function ordreMission()
    {
        return $this->belongsTo(OrdreMission::class, 'idOrdreMission');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
