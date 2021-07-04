<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrCreateRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function __construct() {
        $this->middleware("TasksMiddlware")->only([
            "createTaskView",
            "createOrUpdate"
        ]);
    }

    public function index()
    {
        return Inertia::render('TodoList');
    }

    public function fetch()
    {
        if (!request()->ajax()) { return redirect("/"); }
        $tasks = Task::latest()->simplePaginate(10);
        return response()->json(["tasks" => $tasks]);
    }

    public function createTaskView()
    {
        return Inertia::render('Create');
    }

    public function createOrUpdate(UpdateOrCreateRequest $request)
    {
        Task::updateOrCreate([
            "id" => $request->id
        ], $request->all());
        return redirect(route("index"));
    }

    public function editTaskView($id)
    {
        $task = Task::find($id);

        if ($task) {
            return Inertia::render('Edit', [
                "task" => $task
            ]);
        }

        return back();
    }

    public function changeStatus(Request $request)
    {
        $task = Task::find($request->id);
        if ($task) {
            $task->status = $request->status;
            $task->completed_at = ($request->status == "Completed") ? Carbon::now() : NULL;
            $task->save();
        }
    }
    
    public function deleteTask(Request $request)
    {
        $task = Task::find($request->id);
        if ($task) {
            $task->delete();
        }
    }
}