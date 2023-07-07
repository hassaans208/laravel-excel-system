<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\IntermediateUsersHasCustomer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileController extends Controller
{
    public function assignCustomersToUsers(Request $request)
    {
        validator()->make($request->toArray(), [
            'import' => 'required',
            'users_id' => 'required',
        ])->validated();

        $user_id = explode(',', $request->users_id);

        $import = new CustomerImport;
        $import = $import->import($request->file('import'));
        $collection = FileUpload::getCollection()->toArray();

        $number_collection = count($collection) ? floor(count($collection) / 2) : 0;
        $number_users = count($user_id) ? floor(count($user_id) / 2) : (count($user_id) > 1 ? 1 : 0);
        $roundedHalf = round($number_collection / $number_users);

        $id = 0;

        for ($i = 0; $i < count($user_id); $i++) {

            if ($i >= 1) {

                $id = $roundedHalf;
                $roundedHalf += $roundedHalf;

            }

            for ($j = $id; $j < $roundedHalf; $j++) {

                $customers = Customer::where('email', $collection[$j][1])->first();
                $data = ['user_id' => $user_id[$i], 'customer_id' => $customers->id];
                IntermediateUsersHasCustomer::insert($data);

            }
        }


        return redirect()->route('admin.users.index')->with('message', 'Users assigned to customers Successfuly');

    }
    public function import(Request $request)
    {
        validator()->make($request->toArray(), [
            'import' => 'required'
        ])->validate();

        $import = new CustomerImport;
        $import = $import->import($request->file('import'));

        return redirect()->route('admin.customers.index')->with('message', 'Customers Imported Successfuly');

    }
}
