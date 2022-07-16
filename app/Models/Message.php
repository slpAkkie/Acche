<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Illuminate\Database\Query\Builder
 */
class Message extends Model
{
    use HasFactory;

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = [
        'chat',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_nickname',
        'chat_id',
        'content',
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function sentAt(): Attribute
    {
        return Attribute::make(
            get: fn ($val) => Carbon::parse($val)->format('H:i d.m.Y'),
        );
    }

    /**
     * Relation: Message author.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_nickname');
    }

    /**
     * Relation: Chat
     *
     * @return BelongsTo
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
