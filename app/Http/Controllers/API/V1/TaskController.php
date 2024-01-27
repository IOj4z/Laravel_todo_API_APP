<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;
/**
 * @OA\Info(
 *      title="Your API Title",
 *      version="1.0.0",
 *      description="Your API Description"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="basicAuth",
 *     in="header",
 *     name="Authorization",
 *     type="http",
 *     scheme="basic"
 * )
 */
class TaskController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/tasks",
     *      operationId="getTasksList",
     *      tags={"Tasks"},
     *      summary="Get list of tasks",
     *      description="Returns list of tasks",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *      ),
     * )
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, Response::HTTP_OK);
    }


    /**
     * @OA\Post(
     *      path="/api/v1/tasks",
     *      operationId="storeTask",
     *      tags={"Tasks"},
     *      summary="Store a new task",
     *      description="Store a new task",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Task created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *      ),
     *      security={
     *           {"basicAuth": {}}
     *      }
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'completed' => 'required|boolean',
        ]);

        $task = Task::create($validatedData);

        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/tasks/{id}",
     *      operationId="getTaskById",
     *      tags={"Tasks"},
     *      summary="Get task information",
     *      description="Returns task data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *      ),
     *       security={
     *            {"basicAuth": {}}
     *         }
     * )
     */
    public function show(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($task, Response::HTTP_OK);
    }


    /**
     * @OA\Put(
     *      path="/api/v1/tasks/{id}",
     *      operationId="updateTask",
     *      tags={"Tasks"},
     *      summary="Update an existing task",
     *      description="Update an existing task",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Task updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Task")
     *      ),
     *       security={
     *            {"basicAuth": {}}
     *         }
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'completed' => 'required|boolean',
        ]);

        $task = Task::findOrFail($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $task->update($validatedData);

        return response()->json($task, Response::HTTP_OK);

    }

    /**
     * @OA\Delete(
     *      path="/api/v1/tasks/{id}",
     *      operationId="deleteTask",
     *      tags={"Tasks"},
     *      summary="Delete an existing task",
     *      description="Delete an existing task",
     *      @OA\Parameter(
     *          name="id",
     *          description="Task ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Task deleted successfully",
     *      ),
     *       security={
     *             {"basicAuth": {}}
     *          }
     * )
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
        }

        $task->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
