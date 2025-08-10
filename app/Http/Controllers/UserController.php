<?php
/**
 * UserController.php
 *
 * PHP Version 8.3
 *
 * @category  File
 * @package   booking-api
 * @author    Sandal <sandalkaigorodov@gmail.com>
 * @copyright 2025 booking-api
 * @license   MIT License
 * @link      https://github.com/malaneph/booking-api
 */

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user() ?? [];
    }

    public function login(LoginRequest $request)
    {
        $user = User::query()->firstWhere('email', $request->validated('email'));

        if ($user) {
            return [
                'token' => $user->createToken('token_name')->plainTextToken
            ];
        }

        return [
            'message' => 'Unauthorized'
        ];
    }
}
