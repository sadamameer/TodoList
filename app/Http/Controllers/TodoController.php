<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrCreateRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    protected $request;

    public function __construct() {
        $this->middleware("TasksMiddlware")->only([
            "createTaskView",
            "createOrUpdate"
        ]);

        $this->request = request();
    }

    public function index()
    {
        return Inertia::render('TodoList');
    }

    public function fetch()
    {
        if (!request()->ajax()) { return redirect("/"); }

        $tasks = Task::title($this->request->search)
                        ->status($this->request->status)
                        ->priority($this->request->priority)
                        ->since($this->request->since)
                        ->with(["logs"])
                        ->latest()
                        ->simplePaginate(10);

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
        return redirect()->route("index");
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

    public function changeStatus()
    {
        $task = Task::find($this->request->id);
        if ($task) {
            $task->status = $this->request->status;
            $task->completed_at = ($this->request->status == "Completed") ? Carbon::now() : NULL;
            $task->save();
        }
    }
    
    public function deleteTask()
    {
        $task = Task::find($this->request->id);
        if ($task) {
            $task->delete();
        }
    }
}