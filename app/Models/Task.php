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

    //Mutators
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

    //Scopes
    public function scopeTitle($query, $search)
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%".$search."%");
        }

        return $query;
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }
    
    public function scopePriority($query, $priority)
    {
        if ($priority) {
            return $query->where('priority', $priority);
        }

        return $query;
    }
    
    public function scopeSince($query, $since)
    {
        if ($since) {
            return $query->whereDate('created_at', $since);
        }

        return $query;
    }

    //Relations
    public function logs()
    {
        return $this->hasMany(TaskLog::class);
    }
}