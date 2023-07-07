<?php

namespace App\Helpers;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
use App\Models\Comprehension;
use App\Exceptions\NoDataException;

class FileUpload
{
    private static $collect;
    private $array = [];
    private $size;
    private $number;

    function __construct(object $rows, int $n)
    {
        //Convert COLLECTION to ARRAY
        $substitute = $rows->toArray();
        $this->number = $n;


        // Push $rows element to $array
        foreach ($substitute as $key => $value) {

            $this->array[$key] = [];
            foreach ($value as $k => $v) {
                if (!$v) {
                    continue;
                }
                array_push($this->array[$key], $v);
            }
        }
        $emails = Customer::get()->pluck('email')->toArray();

        foreach ($substitute as $k => $data) {
            $pointer = false;
            foreach ($emails as $key => $email) {
                if (!$data || $email == $data[1])
                    $pointer = true;
            }
            if ($pointer)
                continue;
            $this->array[$k] = [
                $data[0],
                $data[1],
                $data[2],
            ];
        }
        $array = [];
        foreach ($substitute as $k => $data) {
            $pointer = false;
            foreach ($emails as $key => $email) {
                if (!$data || $email == $data[1])
                    $pointer = true;
            }
            if ($pointer)
                continue;
            $array[$k] = [
                $data[0],
                $data[1],
                $data[2],
            ];
        }
        // foreach ($this->array as $k => $data) {
        //     $pointer = false;
        //     foreach ($emails as $key => $email) {
        //         if (!$data || $email == $data[1])
        //         $pointer = true;
        //     }
        //     if ($pointer)
        //         continue;
        //     $this->array[$k] = [
        //         $data[0],
        //         $data[1],
        //         $data[2],
        //     ];
        // }
        // $array = $this->array;
        $array = $this->uniquAsoc($array, 1);
        $this->array = $array;

        $count = count($this->array);


        // Reindexing
        $this->array = array_values($this->array);

        if (!$this->array) {
           return redirect()->back()->with('error','Change Your File, either every customer is added or file is empty');
        }
        // Convert Array to Collection
        self::$collect = collect();
        // Fill Collection
        foreach ($this->array as $key => $value) {
            self::$collect->push($value);
        }

    }
    function uniquAsoc($array, $key)
    {
        $resArray = [];
        foreach ($array as $val) {
            if (empty($resArray)) {
                array_push($resArray, $val);
            } else {
                $value = array_column($resArray, $key);
                if (!in_array($val[$key], $value)) {
                    array_push($resArray, $val);
                }
            }
        }

        return $resArray;
    }
    // function uniqueArray($array, $key)
    // {
    //     $unique = [];
    //     $checkArray = $array;
    //     foreach ($array as $col) {
    //         foreach ($checkArray as $column) {
    //             // dd($col);
    //             if($column[$key] == $col[$key]) continue;
    //             array_push($unique, $col);
    //         }
    //     }
    //     return $unique;
    // }
    public static function  getCollection(): Collection
    {
        return FileUpload::$collect ? FileUpload::$collect : collect();
    }
    public function getSize()
    {
        try {
            if ($this->collect) {

                $this->size = collect([
                    'size' => count($this->collect[0]),
                ]);

                return $this->size;
            }

            throw new \Exception('No Data');

        } catch (EmptyValidationList $e) {
            return $e->getCode() . ' ' . $e->getFile() . ' ' . $e->getLine() . ' ' . $e->getMessage();
        }
    }

    public function getNumber()
    {
        return $this->number;
    }


    public function removeHeader(Collection $collect): Collection|string
    {
        try {
            if ($collect) {

                $collect->pull(0);
                return $collect;
            }

            throw new \Exception('No Data');
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
