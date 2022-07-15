<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Chat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'user_nickname',
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        if (count($attributes) && !$this->exists && key_exists('password', $attributes)) {
            $this->setPassword($attributes['password']);
            unset($attributes['password']);
        }

        parent::__construct($attributes);
    }

    /**
     * Set new password
     *
     * @param string $password
     * @return void
     */
    private function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    /**
     * Check if password correct for the user
     *
     * @param string $password
     * @return boolean
     */
    public function checkPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    /**
     * Relation: Chat owner user
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_nickname');
    }

    /**
     * Relation: Chat participants
     *
     * @return BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Relation: chat messages
     *
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
