<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $datas = [
            'limit' => 50,
        ];
        return $this->imageService->getData($datas);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:3072',
            'enable' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        return $this->imageService->insertData($request);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
            'enable' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        return $this->imageService->updateData($request);
    }

    public function destroy(Request $request)
    {
        return $this->imageService->deleteData($request->id);
    }
}
