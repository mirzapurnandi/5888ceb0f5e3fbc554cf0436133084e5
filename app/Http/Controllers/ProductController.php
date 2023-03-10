<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $datas = [
            'limit' => 50,
        ];
        return $this->productService->getData($datas);
    }

    public function view(Request $request)
    {
        return $this->productService->getData([], $request->id);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required',
            'enable' => 'required|boolean',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        return $this->productService->insertData($request);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'description' => 'string',
            'enable' => 'required|boolean',
            'category_id' => 'array',
            'category_id.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        return $this->productService->updateData($request);
    }

    public function destroy(Request $request)
    {
        return $this->productService->deleteData($request->id);
    }

    public function store_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'function' => 'required',
            'product_id' => 'required|exists:products,id',
            'image_id' => 'required|array',
            'image_id.*' => 'exists:images,id'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

        return $this->productService->insertImage($request);
    }
}
