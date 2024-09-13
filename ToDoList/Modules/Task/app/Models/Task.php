<?php

namespace Modules\Task\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\app\Models\User;

/**
 * @method static select(string $string, string $string1, string $string2, string $string3, string $string4, string $string5)
 */
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
