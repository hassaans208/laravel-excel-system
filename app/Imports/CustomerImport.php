<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use App\Helpers\FileUpload;

class CustomerImport implements ToCollection, SkipsOnError, SkipsEmptyRows
{
    use Importable, SkipsErrors;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $check = $collection;
        $file = new FileUpload($collection, 3);
        // dd($collection);
        $collect = FileUpload::getCollection();
        // $obj = $file->getSize();
        // $no = $file->getNumber();
        // dd($collect);

        foreach ($collect as $row) {
            Customer::create([
                'name' => $row[0],
                'email' => $row[1],
                'phone_no' => $row[2],
            ]);
        }
    }
}
