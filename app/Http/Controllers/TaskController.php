<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
/**
 * @OA\Get(
 *     path="/tasks",
 *     summary="Get list of tasks",
 *     tags={"Tasks"},
 *     @OA\Response(
 *         response=200,
 *         description="List of tasks",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/TaskResource"))
 *     )
 * )
 * @OA\Post(
 *      path="/tasks",
 *      summary="Create a new task",
 *      tags={"Tasks"},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"title","description"},
 *              @OA\Property(property="title", type="string", example="New Task"),
 *              @OA\Property(property="description", type="string", example="Description of the task"),
 *              @OA\Property(
 *                  property="status",
 *                  type="string",
 *                  enum={"pending","in_progress","done"},
 *                  example="pending"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Task created successfully",
 *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="message",
 *                  type="string",
 *                  example="The given data was invalid."
 *              ),
 *              @OA\Property(
 *                  property="errors",
 *                  type="object",
 *                  example={
 *                      "title": {"The title field is required."},
 *                      "status": {"The selected status is invalid."}
 *                  }
 *              )
 *          )
 *      )
 *  )
 * @OA\Get(
 *      path="/tasks/{id}",
 *      summary="Get a single task",
 *      tags={"Tasks"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the task to retrieve",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Task retrieved successfully",
 *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Task not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Task not found")
 *          )
 *      )
 *  )
 * @OA\Put(
 *      path="/tasks/{id}",
 *      summary="Update an existing task",
 *      tags={"Tasks"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the task to update",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"title","description"},
 *              @OA\Property(property="title", type="string", example="Updated Task"),
 *              @OA\Property(property="description", type="string", example="Updated description"),
 *              @OA\Property(
 *                  property="status",
 *                  type="string",
 *                  enum={"pending","in_progress","done"},
 *                  example="in_progress"
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Task updated successfully",
 *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              @OA\Property(
 *                  property="message",
 *                  type="string",
 *                  example="The given data was invalid."
 *              ),
 *              @OA\Property(
 *                  property="errors",
 *                  type="object",
 *                  example={
 *                      "title": {"The title field is required."},
 *                      "status": {"The selected status is invalid."}
 *                  }
 *              )
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Task not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Task not found")
 *          )
 *      )
 *  )
 * @OA\Delete(
 *      path="/tasks/{id}",
 *      summary="Delete a task",
 *      tags={"Tasks"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID of the task to delete",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *      @OA\Response(
 *          response=204,
 *          description="Task deleted successfully, no content returned"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Task not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Task not found")
 *          )
 *      )
 *  )
 */
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
