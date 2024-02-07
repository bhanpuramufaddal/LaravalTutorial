<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany; // Add a semicolon at the end of this line

class Task extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'is_completed',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

}
