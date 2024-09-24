<?php

namespace Modules\Task\app\Models;

use App\Models\Category;
use Iben\Statable\Statable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;
use Modules\User\app\Models\User;

class Task extends Model
{
    use HasFactory, NodeTrait, Statable;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'status',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime:Y-m-d',
    ];

    // Relation between user and task
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation between category and task
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected function getGraph(): string
    {
        return 'task';
    }

    protected function saveBeforeTransition(): bool
    {
        return true;
    }
}
