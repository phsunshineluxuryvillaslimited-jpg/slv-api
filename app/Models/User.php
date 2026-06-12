<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['company', 'name', 'email', 'role_id', 'password'])]
#[Hidden(['password', 'remember_token', 'email_verified_at'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted(): void
    {

        // Automatically filter out admin users from general queries
        static::addGlobalScope('exclude_admins', function (Builder $builder) {
            $exceptRoleIds = [5, 6];
            $builder->whereNotIn('role_id', $exceptRoleIds);
        });
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'created_by');
    }

    public function propertyManagingAgent(): HasMany
    {
        return $this->hasMany(Property::class, 'managing_agent_user_id');
    }
}
