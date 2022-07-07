<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;


class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if($request->file('preview_image')){
            $file= $request->file('preview_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/images'), $filename);
            $data['preview_image']= $filename;
        }
        $product->update($data);

        return view('product.show', compact('product'));
    }
}
