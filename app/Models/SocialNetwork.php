<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SocialNetwork extends Model
{
    /** @use HasFactory<\Database\Factories\SocialNetworkFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'url'
    ];
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)
            ->withPivot('username');
    }
}
