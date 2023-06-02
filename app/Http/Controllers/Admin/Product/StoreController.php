<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Requests\Admin\Product\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);

        return redirect()->route('admin.main.index');
    }
}
