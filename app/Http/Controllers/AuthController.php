<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email_or_name)
            ->orWhere('name', $request->email_or_name)
            ->first();
        if ($user) {
            if (Hash::check($request->password, $user->password) || Hash::check($request->password, $user->name)) {
                return response()->json([
                    'user' => $user,
                    'token' => $user->createToken(time())->plainTextToken,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Invalid credentials',
                    'user' => null,
                    'token' => null,
                ], 401);
            }
        }
    }

    public function categoryList()
    {
        $category = Category::GET();
        return response()->json([
            'category' => $category
        ]);
    }

    public function register(Request $request)
    {
        {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            User::create($data);

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken,
            ]);
        }
    }
}
