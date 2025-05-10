<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo'];

    public function homeMatches()
    {
        return $this->hasMany(Matche::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Matche::class, 'away_team_id');
    }
}
