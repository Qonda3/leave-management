<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var list<string>
     */
    protected $fillable = [
        'name', 
        'default_days', 
        'description'
    ];

    /**
     * Get the leave requests associated with this leave type.
     */
    public function leaveRequest()
    {
        return $this->hasMany(LeaveRequet::class);
    }

    /**
     * Get the leave balances associated with this leave type.
     */
    public function leaveBalances()
    {
        return $this->hasMany(LeaveBalance::class);
    }
}
