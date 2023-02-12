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

    public function insertData($request, $name_file)
    {
        try {
            $data = new Image();
            $data->name = $request->name;
            $data->file = $name_file;
            $data->enable = $request->enable;
            $data->save();

            return $this->successResponse($data, $this->name . ' ' . $data->name . ' berhasil dibuat.');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat insert ' . $this->name);
        }
    }
}
