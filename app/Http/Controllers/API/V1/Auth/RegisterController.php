<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;


class RegisterController extends Controller
{
    /**
     * Register a new user.
     *
     * @OA\Post(
     *      path="/api/v1/register",
     *      operationId="registerUser",
     *      tags={"Authentication"},
     *      summary="Register a new user",
     *      description="Registers a new user with the provided name, email, and password.",
     *      @OA\RequestBody(
     *          required=true,
     *          description="User registration details",
     *          @OA\JsonContent(
     *              required={"name", "email", "password", "password_confirmation"},
     *              @OA\Property(property="name", type="string", example="John Doe", description="User's name"),
     *              @OA\Property(property="email", type="string", format="email", example="john@example.com", description="User's email"),
     *              @OA\Property(property="password", type="string", format="password", example="password123", description="User's password"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="password123", description="Confirmation of user's password")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="User registered successfully",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="user", ref="#/components/schemas/User"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *          ),
     *      ),
     * )
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',],
        ]);


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json(['user' => $user], Response::HTTP_CREATED);
    }

}
