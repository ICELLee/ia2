<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // ← hier die tatsächlich existierende Tabelle angeben
    protected $table = 'job_types';

    protected $fillable = ['name','label'];

    public function teamMembers()
    {
        return $this->belongsToMany(
            TeamMember::class,
            'team_member_job',     // ← pivot
            'job_id',              // ← this model’s FK
            'team_member_id'       // ← related FK
        );
    }
}
