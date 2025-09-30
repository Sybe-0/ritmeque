<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    /** @use HasFactory<\Database\Factories\LibraryFactory> */
    use HasFactory;

    protected $table = 'libraries';

    protected $fillable = [
        'title',
        'users_id',
        'description',
        'platform',
        'is_favorite',
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
        'is_favorite' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
