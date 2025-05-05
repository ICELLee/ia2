<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name','artist_name','email','image_path','is_visible',
    ];

    public function jobs()
    {
        return $this->belongsToMany(
            Job::class,
            'team_member_job',     // ← your actual pivot table
            'team_member_id',      // ← this model’s FK
            'job_id'               // ← related model’s FK
        );
    }
}
