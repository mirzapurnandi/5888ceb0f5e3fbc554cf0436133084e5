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

    public function insertData($request)
    {
        try {
            $name_file = '';
            if ($request->hasfile('file')) {
                $file = $request->file('file');
                $name_file = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/product/'), $name_file);
            }

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

    public function updateData($request)
    {
        try {
            $data = Image::findOrFail($request->id);

            $name_file = '';
            if ($request->hasfile('file')) {
                $file = $request->file('file');
                $name_file = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/product/'), $name_file);
                if ($data->file != null) {
                    $cekimage = public_path('images/product/' . $data->file);
                    if (file_exists($cekimage)) unlink($cekimage);
                }
            }

            if ($request->name || $request->name != "") $data->name = $request->name;
            if ($name_file != "") $data->file = $name_file;
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
            $data = Image::findOrFail($id);
            if ($data->file != null) {
                $cekimage = public_path('images/product/' . $data->file);
                if (file_exists($cekimage)) unlink($cekimage);
            }
            $data->delete();
            return $this->successResponse(null, $this->name . ' berhasil dihapus');
        } catch (\Throwable $th) {
            throw new SurplusException('Maaf, gagal menghapus ' . $this->name);
        }
    }
}
