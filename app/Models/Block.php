<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'json'
    ];

    // protected $casts = [
    //     'start_date' => 'datetime: Y-m-d',
    //     'deadline' => 'datetime: Y-m-d'
    // ]

    // Relationship to User
        public function user(): BelongsTo{
            return $this->belongsTo(User::class, 'user_id');
        }
}
