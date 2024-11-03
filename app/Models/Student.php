<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'nt_id',
        'first_name',
        'last_name',
        'middle_name',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'bio',
        'image',
    ];

    public function socialNetworks(): BelongsToMany
    {
        return $this->belongsToMany(SocialNetwork::class)
            ->withPivot('username');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class)
            ->withPivot('level_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }
}
