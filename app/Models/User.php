<?php

namespace App\Models;

use App\Common\Interfaces\StudentRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int id
 * @property string phone
 * @property string name
 * @property string email
 * @property string profile_photo_path
 * @property bool active
 * @property Group group
 * @property int role
 * @property string vk_id
 * @property string google_id
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function isStudent(): bool
    {
        return $this->role === StudentRole::STUDENT;
    }

    public function isEnrollee(): bool
    {
        return $this->role === StudentRole::ENROLLEE;
    }

    public function isGraduated(): bool
    {
        return $this->role === StudentRole::GRADUATED;
    }

    /**
     * Scope a query to only include active users.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    /**
     * Determine whether User is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * Determines whether user logged in using social networks
     *
     * @return bool
     */
    public function isSocialiteUser(): bool
    {
        return $this->vk_id || $this->google_id;
    }

    /**
     * @return HasOne
     */
    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }

    /**
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(Person::class, 'parent_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function limit(): HasMany
    {
        return $this->hasMany(Limit::class);
    }
}
