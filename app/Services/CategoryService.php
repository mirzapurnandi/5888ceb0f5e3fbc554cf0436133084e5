<?php

namespace App\Services;

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

    public function insertData($datas)
    {
        //
    }
}
