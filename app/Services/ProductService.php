<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Exceptions\SurplusException;

class ProductService
{
    use ApiResponser;

    protected $name;

    public function __construct()
    {
        $this->name = 'Product';
    }

    public function getData($datas)
    {
        try {
            $result = Product::simplepaginate($datas['limit']);
            return $this->successResponse($result, 'Success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), $th->getCode());
        }
    }

    public function insertData($request)
    {
        try {
            $data = new Product();
            $data->name = $request->name;
            $data->description = $request->description;
            $data->enable = $request->enable;
            $data->save();
            $data->categories()->attach($request->category_id);

            return $this->successResponse($data, $this->name . ' ' . $data->name . ' berhasil dibuat.');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat insert ' . $this->name);
        }
    }

    public function updateData($request)
    {
        //
    }

    public function deleteData($id)
    {
        //
    }
}
