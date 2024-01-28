<?php

namespace App\Http\Controllers\API\V1;

use App\Events\EventCreated;
use App\Events\EventDeleted;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class EventController extends Controller
{

    /**
     * @OA\Post(
     *      path="/api/v1/events",
     *      operationId="createEvent",
     *      tags={"Events"},
     *      summary="Create a new event",
     *      description="Create a new event",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Event")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Event created successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Event")
     *      ),
     *      security={
     *           {"basicAuth": {}}
     *      }
     * )
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $event = Event::create($validatedData);
        $userId = Auth::id();
        event(new EventCreated($event, $userId));


        return response()->json(['message' => 'Event created successfully', 'event' => $event], 201);
    }


    /**
     * @OA\Delete(
     *      path="/api/v1/events/{id}",
     *      operationId="deleteEvent",
     *      tags={"Events"},
     *      summary="Delete an existing event",
     *      description="Delete an existing event",
     *      @OA\Parameter(
     *          name="id",
     *          description="Event ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Event deleted successfully",
     *      ),
     *       security={
     *             {"basicAuth": {}}
     *          }
     * )
     */
    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->delete();

        $userId = Auth::id();
        event(new EventDeleted($event, $userId));

        // Возвращаем успешный ответ
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
