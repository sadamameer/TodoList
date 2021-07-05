<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = [
        "task_id",
        "action",
        "description",
    ];

    protected $appends = [
        "created_date",
    ];

    //Mutators
    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->toDayDateTimeString();
    }
    
    //Relations
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}