<?php

namespace App\Interfaces;

use App\Http\Requests\UpdateOrCreateRequest;

interface  TodoInterface
{
    public function index();
    public function fetch();
    public function createTaskView();
    public function createOrUpdate(UpdateOrCreateRequest $request);
    public function editTaskView($id);
    public function changeStatus();
    public function deleteTask();
}