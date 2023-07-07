<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::get();
        return view('admin.customers.index', compact('customers'));
    }
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.show', compact('customer'));
    }
    public function create()
    {
        return view('admin.customers.create');
    }


    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.edit', compact('customer'));
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
            'phone_no' => 'numeric|required',
        ])->validated();

        try {

            $data = $validated;

            // DB will rollback in case of any error occurs, useful when multiple
            // transactions are performed

            DB::beginTransaction();

            Customer::create($data);

            DB::commit();

            return redirect()->route('admin.users.index')->with('message', 'Customer Created Successfuly');


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
            'phone_no' => 'numeric|required',
        ])->validated();

        try {

            // DB will rollback in case of any error occurs, useful when multiple
            // transactions are performed
            $data = $validated;

            DB::beginTransaction();

            Customer::find($id)->update($data);

            DB::commit();

            return redirect()->route('admin.customers.index')->with('message', 'Customer Updated Successfuly');

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

            $customer = Customer::find($id);

            // if the :id is not correct throe err
            if (!$customer)

                return redirect()->back()->with('errors', 'Customer not found');


            // else delete the user
            if ($customer)
                $customer->delete();

            DB::commit();

            return redirect()->route('admin.customers.index')->with('message', 'Customer Deleted Successfuly');

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 400,
                'message' => $e->getMessage(),
            ], 400);
        }

    }
}
