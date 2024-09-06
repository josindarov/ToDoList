<?php

namespace Modules\Task\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\app\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'completed',
        'deadline'
    ];

    protected $casts = [
      'deadline' => 'datetime:Y-m-d'
    ];

    // Relation between user and task
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
