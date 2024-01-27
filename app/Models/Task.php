<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Task",
 *     required={"id", "title", "description", "completed", "created_at", "updated_at"},
 *     description="Task model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="The unique identifier of the task",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="The title of the task",
 *         example="Finish assignment"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="The description of the task",
 *         example="This is the description of the task"
 *     ),
 *     @OA\Property(
 *         property="completed",
 *         type="boolean",
 *         description="The status of the task (completed or not)",
 *         example="true"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="The timestamp when the task was created",
 *         example="2024-01-26 12:00:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="The timestamp when the task was last updated",
 *         example="2024-01-26 12:30:00"
 *     )
 * )
 */



class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'completed' , 'description'];

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => (string) $this->title,
            'description' => (string) $this->description,
            'completed' => (bool) $this->completed,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
