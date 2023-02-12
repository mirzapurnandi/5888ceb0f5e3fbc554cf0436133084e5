<?php

namespace App\Services;

use App\Exceptions\SurplusException;
use App\Models\Category;
use App\Traits\ApiResponser;

class CategoryService
{
    use ApiResponser;

    public function getData($datas)
    {
        try {
            $result = Category::simplepaginate($datas['limit']);
            return $this->successResponse($result, 'Success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), $th->getCode());
        }
    }

    public function insertData($request)
    {
        try {
            $data = new Category();
            $data->name = $request->name;
            $data->enable = $request->enable;
            $data->save();

            return $this->successResponse($data, "Category " . $data->name . " berhasil dibuat.");
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat insert Category');
        }
    }
}
