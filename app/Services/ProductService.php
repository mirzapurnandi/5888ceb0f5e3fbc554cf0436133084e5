<?php

namespace App\Services;

use App\Exceptions\SurplusException;
use App\Traits\ApiResponser;

class ProductService
{
    use ApiResponser;

    protected $name;

    public function __construct()
    {
        $this->name = 'Product';
    }

    public function getData($datas)
    {
        //
    }

    public function insertData($request)
    {
        //
    }

    public function updateData($request)
    {
        //
    }

    public function deleteData($id)
    {
        //
    }
}
