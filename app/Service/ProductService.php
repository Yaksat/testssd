<?php

namespace App\Service;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store($data)
    {
        try {
            Db::beginTransaction();

            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

            $product = Product::Create($data);

            Db::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            abort(500);
        }
    }
}
