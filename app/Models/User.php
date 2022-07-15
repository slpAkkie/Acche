<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'nickname';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nickname',
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * Relation: User chats
     *
     * @return BelongsToMany
     */
    public function chats()
    {
        return $this->belongsToMany(Chat::class);
    }
}
