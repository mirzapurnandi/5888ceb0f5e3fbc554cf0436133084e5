<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\ApiResponser;
use App\Exceptions\SurplusException;

class ProductService
{
    use ApiResponser;

    protected $name;

    public function __construct()
    {
        $this->name = 'Product';
    }

    public function getData($datas, $id = null)
    {
        try {
            if ($id != "") {
                $result = Product::with('categories:id,name,enable')->where('id', $id)->first();
            } else {
                $result = Product::with('categories:id,name,enable')->simplepaginate($datas['limit']);
            }
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
        try {
            $data = Product::findOrFail($request->id);
            if ($request->name || $request->name != "") $data->name = $request->name;
            if ($request->description || $request->description != "") $data->description = $request->description;
            $data->enable = $request->enable;
            $data->save();
            if ($request->category_id) {
                $data->categories()->sync($request->category_id);
            }

            return $this->successResponse($data, $this->name . ' ' . $data->name . ' berhasil diperbaharui.');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat update ' . $this->name);
        }
    }

    public function deleteData($id)
    {
        try {
            $data = Product::findOrFail($id);
            $data->categories()->detach();
            $data->delete();
            return $this->successResponse(null, $this->name . ' berhasil dihapus');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, gagal menghapus ' . $this->name);
        }
    }

    public function insertImage($request)
    {
        try {
            $data = Product::findOrFail($request->product_id);
            $data->images()->attach($request->image_id);

            return $this->successResponse($data, 'Image berhasil ditambahkan.');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, terjadi kesalahan saat insert Image');
        }
    }
}
