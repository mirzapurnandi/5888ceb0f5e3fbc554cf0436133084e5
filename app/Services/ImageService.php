<?php

namespace App\Services;

use App\Models\Image;
use App\Traits\ApiResponser;
use App\Exceptions\SurplusException;

class ImageService
{
    use ApiResponser;

    protected $name;

    public function __construct()
    {
        $this->name = 'Image';
    }

    public function getData($datas)
    {
        try {
            $result = Image::simplepaginate($datas['limit']);
            return $this->successResponse($result, 'Success');
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), $th->getCode());
        }
    }
}
