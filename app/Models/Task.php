<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "title",
        "status",
        "completed_at"
    ];

    protected $appends = [
        "created_date",
        "completed_date"
    ];

    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
    }

    public function getCompletedDateAttribute()
    {
        return Carbon::parse($this->completed_at)->toDayDateTimeString();
    }
}
