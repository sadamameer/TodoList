<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\TaskLog;

class TaskObserver
{
    public function created(Task $task)
    {
        $this->createLog($task, "created");
    }

    public function updated(Task $task)
    {
        $this->createLog($task, "updated");
    }

    public function createLog($task, $status)
    {
        TaskLog::create([
            "task_id" => $task->id,
            "action" => $status,
            "description" => "<b>Title:</b> " . $task->title . " | <b>Description</b>: " . $task->description . " | <b>Status</b>: " . $task->status . " | <b>Priority</b>: " . $task->priority,
        ]);
    }
}