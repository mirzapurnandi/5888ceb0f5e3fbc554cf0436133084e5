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

        $filename = '';
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product/'), $filename);
        }

        return $this->imageService->insertData($request, $filename);
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

        $filename = '';
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/product/'), $filename);
        }

        return $this->imageService->updateData($request, $filename);
    }

    public function destroy(Request $request)
    {
        return $this->imageService->deleteData($request->id);
    }
}
