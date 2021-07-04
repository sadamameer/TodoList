<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TasksMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $tasks = Task::where("status", "Not Started");

        if ($tasks->count() >= 3) {
            Session::flash("tasks_overflow", "You have more than 3 pending tasks left. Please complete these before adding new tasks.");
            return back();
        }

        return $next($request);
    }
}
