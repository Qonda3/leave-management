<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'leave_type_id',
        'total_days',
        'used_days',
    ];

    /**
     * Get the user that owns this leave balance.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the leave type associated with this leave balance.
     */
    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }

    /**
     * Get the remaining leave days for the user.
     */
    public function getRemainingDaysAttribute(): int
    {
        return $this->total_days - $this->used_days;
    }
}
