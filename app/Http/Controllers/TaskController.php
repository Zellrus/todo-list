<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $task = Task::create($data);
        return TaskResource::make($task);
    }

    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    public function update(UpdateRequest $request, Task $task)
    {

        $data = $request->validated();
        $task->update($data);
        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->NoContent();
    }
}
