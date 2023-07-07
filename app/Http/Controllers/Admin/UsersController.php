<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.users.index', compact('users'));
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }
    public function create()
    {
    return view('admin.users.create');
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }
    /**
     * Create a new user.
     *
     * @param \Illuminate\Http\Request $request
     */

    public function store(Request $request)
    {
        $validated = \Validator::make($request->toArray(), [
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|unique:users|confirmed',
            'password_confirmation' => 'required',
        ])->validated();

        try {

            $data = $validated;

            $data['password'] = Hash::make($data['password']);

            // DB will rollback in case of any error occurs, useful when multiple
            // transactions are performed

            DB::beginTransaction();

            $user = User::create($data);

            DB::commit();

            return redirect()->route('admin.users.index')->with('message', 'User Created Successfuly');


        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }

    }

    /**
     * Update a specific user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */

    public function update(Request $request, $id)
    {
        $validated = \Validator::make($request->toArray(), [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ],
            'password' => 'required|unique:users|confirmed',
            'password_confirmation' => 'required',
        ])->validated();

        try {

            // DB will rollback in case of any error occurs, useful when multiple
            // transactions are performed
            $data = $validated;

            $data['password'] = Hash::make($data['password']);

            DB::beginTransaction();

            $user = User::find($id);


            $user->update($data);

            $user = User::find($id);

            DB::commit();

            return redirect()->route('admin.users.index')->with('message', 'User Updated Successfuly');

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 404);
        }

    }

    /**
     * Delete a specific user.
     *
     * @param int $id
     */

    public function destroy(Request $request, $id)
    {
        try {
            // DB will rollback in case of any error occurs, useful when multiple
            // transactions are performed

            DB::beginTransaction();

            $user = User::find($id);

            // if the :id is not correct throe err
            if (!$user)

            return redirect()->back()->with('errors', 'User not found');


            // else delete the user
            if ($user)
                $user->delete();

            DB::commit();

            return redirect()->route('admin.users.index')->with('message', 'User Deleted Successfuly');

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }

    }


}
