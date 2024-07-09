<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class PersonalAccessToken extends Model
{
    use HasFactory;
    protected $table = 'personal_access_tokens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'token',
        'abilities',
        'last_used_at',
        'expires_at',
    ];

    /**
     * Get the parent tokenable model (user or any other model).
     */
    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Determine if the token has expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Determine if the token can perform the given ability.
     *
     * @param string $ability
     * @return bool
     */
    public function can(string $ability): bool
    {
        if (is_null($this->abilities)) {
            return true;
        }

        $abilities = explode(',', $this->abilities);

        return in_array('*', $abilities) || in_array($ability, $abilities);
    }
}
