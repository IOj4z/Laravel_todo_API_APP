<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Event",
 *      description="Event model",
 *      @OA\Xml(
 *          name="Event"
 *      )
 * )
 */
class Event extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *      title="ID",
     *      description="ID of the event",
     *      example="1"
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the event",
     *      example="Birthday Party"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the event",
     *      example="A celebration for John's birthday"
     * )
     *
     * @var string|null
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Start Date",
     *      description="Start date of the event",
     *      example="2024-01-28 08:00:00"
     * )
     *
     * @var string
     */
    public $start_date;

    /**
     * @OA\Property(
     *      title="End Date",
     *      description="End date of the event",
     *      example="2024-01-28 18:00:00"
     * )
     *
     * @var string
     */
    public $end_date;

    protected $fillable = ['name', 'description', 'start_date', 'end_date'];
}
