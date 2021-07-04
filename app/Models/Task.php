<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "title",
        "description",
        "image",
        "priority",
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
        return ($this->completed_at) ? Carbon::parse($this->completed_at)->toDayDateTimeString() : "";
    }
    
    public function getImageAttribute($image)
    {
        return ($image) ?? "https://ui-avatars.com/api/?background=212529&color=fff&name=".$this->title;
    }
}
