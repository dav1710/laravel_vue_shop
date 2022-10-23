<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        // $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        if($request->file('preview_image')){
            $file= $request->file('preview_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/images'), $filename);
            $data['preview_image']= $filename;
        }

        // $tagsIds = $data['tags'];
        // $colorsIds = $data['colors'];
        // unset($data['tags'], $data['colors']);
        $data['color_id'] = json_encode( $request->color_id);
        $data['tag_id'] = json_encode( $request->tag_id);
        $product = Product::firstOrCreate([
            'title' => $data['title'],
        ], $data);
  

        // foreach($tagsIds as $tagsId){
        //     ProductTag::firstOrCreate([
        //         'product_id' => $product->id,
        //         'tag_id' => $tagsId,
        //     ]);
        // };

        // foreach($colorsIds as $colorsId){
        //     ColorProduct::firstOrCreate([
        //         'product_id' => $product->id,
        //         'color_id' => $colorsId,
        //     ]);
        // };

        return redirect()->route('product.index');
    }
}
