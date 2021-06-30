<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        return Inertia::render('TodoList', [
            "tasks" => $this->getTasks()
        ]);
    }

    public function getTasks()
    {
        return Task::latest()->get();
    }

    public function createOrUpdate(Request $request)
    {
        Task::updateOrCreate(
            [
                "id" => $request->id
            ],
            [
                "title" => $request->title
            ]
        );

        return $this->getTasks();
    }

    public function changeStatus(Request $request)
    {
        $task = Task::find($request->id);
        
        if ($task) {
            $task->status = $request->status;
            $task->save();
        }

        return $this->getTasks();
    }
}