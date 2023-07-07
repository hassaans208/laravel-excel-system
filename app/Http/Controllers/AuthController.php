<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // $emails = User::get()->pluck('email')->toArray();

        $validator = \Validator::make($request->toArray(), [

            'email' => 'required',
            'password' => 'required',

        ], [

            'email.in' => 'Email not found'

        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        try {

            $data = $validator->validated();

            $user = User::where('email', $data['email'])->first();

            // if email not found
            if (!$user) {
                return redirect()->back()->with('errors', ['User Not Found']);
            }

            if (\Hash::check($data['password'], $user->password)) {

                \Auth::login($user);

                $token = $user->createToken(config('app.name'))->accessToken;

                return response()->json([
                    'status' => 200,
                    'message' => 'User loggedIn successfuly!',
                    'data' => [
                        'user' => $user,
                        'token' => $token,
                    ]
                ], 200);

            } else {
                return redirect()->back()->with('errors', ['Incorrect Password']);
            }


        } catch (\Exception $e) {

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }

    }

}
