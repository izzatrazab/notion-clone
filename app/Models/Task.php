<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'name', 'start', 'end', 'progress', 'dependencies', 'priority', 'order'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
