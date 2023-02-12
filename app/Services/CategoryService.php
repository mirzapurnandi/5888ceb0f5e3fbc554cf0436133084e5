<?php

namespace App\Services;

use App\Exceptions\SurplusException;
use App\Models\Category;
use App\Traits\ApiResponser;

class CategoryService
{
    use ApiResponser;

    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

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

            return $this->successResponse($data, $this->name . ' ' . $data->name . ' berhasil dibuat.');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat insert ' . $this->name);
        }
    }

    public function updateData($request)
    {
        try {
            $data = Category::findOrFail($request->id);
            $data->name = $request->name;
            $data->enable = $request->enable;
            $data->save();

            return $this->successResponse($data, $this->name . ' ' . $data->name . ' berhasil diperbaharui.');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat update ' . $this->name);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = Category::findOrFail($id);
            $data->delete();
            return $this->successResponse(null, $this->name . ' berhasil dihapus');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, gagal menghapus ' . $this->name);
        }
    }
}
