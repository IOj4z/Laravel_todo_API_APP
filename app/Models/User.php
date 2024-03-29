<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(
 *     schema="User",
 *     required={"name", "email"},
 *     @OA\Property(property="name", type="string", example="John Doe", description="User's name"),
 *     @OA\Property(property="email", type="string", format="email", example="john@example.com", description="User's email")
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendWelcomeEmail()
    {
        // Ваша логика отправки приветственного письма
        Mail::to($this->email)->send(new WelcomeEmail($this));
    }
}
