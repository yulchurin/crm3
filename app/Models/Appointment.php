<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @property int id
 * @property Carbon date
 * @property int group_id
 * @property int vehicle_id
 * @property int schedule_id
 * @property int place_id
 * @property int student
 * @property int instructor
 * @property string comment
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'date',
        'group_id',
        'vehicle_id',
        'schedule_id',
        'place_id',
        'student',
        'instructor',
        'comment',
    ];

    protected $dates = ['date'];

    /**
     * Appointment belongs to Driving Schedule
     *
     * @return BelongsTo
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * @return BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'instructor_id');
    }

    /**
     * Scope a query to only available time slots.
     *
     * @param $query
     * @return mixed
     */
    public function scopeAvailable($query): mixed
    {
        return $query
            ->where(function ($query) {
                $query->whereNull('group_id')
                    ->orWhere('group_id', Auth::user()?->group_id);
            })
            ->where(function ($query) {
                $query->whereNull('student_id')
                    ->orWhere('student_id', '=', Auth::id());
            })
            ->where('date', '>', now()->addHours(config('appointment.available.hours_before_start')))
            ->orderBy('date')
            ->orderBy('schedule_id');
    }

    public function scopeOfThisStudent($query)
    {
        return $query->where('student_id', '=', Auth::id());
    }

    public function scopeOfThisInstructor($query)
    {
        return $query->where('instructor_id', '=', Auth::id());
    }

    public function scopeOfThisWeek($query)
    {
        return $query
            ->whereDate('date', '>=', now()->startOfWeek())
            ->whereDate('date', '<=', now()->endOfWeek());
    }

    public function scopeOfToday($query)
    {
        return $query->whereDate('date', today());
    }

    public function scopeOfThisWeekAndHigher($query)
    {
        return $query->whereDate('date', '>=', now()->startOfWeek());
    }

    public function scopeOnlyBooked($query)
    {
        return $query->whereNotNull('student_id');
    }
}
