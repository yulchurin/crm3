<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer id
 * @property boolean gender
 * @property string last_name
 * @property string first_name
 * @property string middle_name
 * @property mixed date_of_birth
 * @property string phone
 * @property string zip
 * @property string region
 * @property string city
 * @property string street
 * @property string house
 * @property string flat
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'gender',
        'last_name',
        'first_name',
        'middle_name',
        'date_of_birth',
        'phone',
        'address_zip',
        'address_region',
        'address_city',
        'address_street',
        'address_house',
        'address_flat',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'date_of_birth',
    ];

    /**
     * Person belongs to the User
     *
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Person has one Passport
     *
     * @return HasOne
     */
    public function passport(): HasOne
    {
        return $this->hasOne(Passport::class);
    }

    /**
     * @return Carbon
     */
    public function getDateOfBirth(): Carbon
    {
        return $this->date_of_birth;
    }
}
