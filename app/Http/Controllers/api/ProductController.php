<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductController extends Controller
{
    public function showAll()
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $products = Product::all();

        if ($products->count() > 0) {
            $res['status'] = true;
            // $res['data'] = $products;
            $res['data'] = ProductResource::collection($products);
            $res['message'] = 'Products Load succefully';
        } else {
            $res['message'] = 'Products not found';
        }

        return response()->json($res);
    }


    public function showSingle($id)
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $product = Product::find($id);

        // $product->categories;

        if ($product) {
            $res['status'] = true;
            $res['data'] = new ProductResource($product);

            $res['message'] = 'Product found successfully';
        } else {
            $res['message'] = 'Product not found';
        }
        return response()->json($res);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products',
            'price' => 'numeric',
            'discount' => 'integer|nullable',
            'image' => 'image|nullable|sometimes',
            'description' => 'string|nullable|sometimes'
        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $product = new Product();
            $product->name = $request->name;
            $product->price = round($request->price , 2);
            $product->discount = $request->discount;
            $product->is_featured = $request->is_featured;


            if ($image_file = $request->file('image')) {
                $extension = $image_file->getClientOriginalExtension();
                $image = 'Product_' . time() . '.' . $extension;
                Image::make($image_file)->save(public_path() . "/uploads/images/" . $image);
                $product->image = $image;
            }

            $product->description = $request->description;

            $product->save();
            //  created new function as attach category so, ai line ta sync ata akany r dibo na 29/03/2022
            // $product->categories()->sync($request->categories);
            $res['status'] = true;
            $res['data'] = new ProductResource($product);
            $res['message'] = "Product Save Succefull!";
        }

        return response()->json($res);
    }

    public function update(Request $request, $id)
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:products,name,'.$id,
            'price' => 'numeric',
            'discount' => 'integer|nullable',
            'image' => 'image|nullable|sometimes',
            'description' => 'string|nullable|sometimes'
        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $product = Product::find($id);

            if (!$product) {
                $res['message'] = "product not found";
            } else {
                $product->name = $request->name;
                $product->price = round($request->price , 2);
                $product->discount = $request->discount;
                $product->description = $request->description;
                $product->is_featured = $request->is_featured;
                if ($image_file = $request->file('image')) {
                    if (file_exists(public_path() . "/uploads/images/" . $product->image)) {
                        @unlink(public_path() . "/uploads/images/" . $product->image);
                    }
                    $extension = $image_file->getClientOriginalExtension();
                    $image = 'Product_' . time() . '.' . $extension;
                    Image::make($image_file)->save(public_path() . "/uploads/images/" . $image);
                    $product->image = $image;
                }
                $product->save();
                $res['status'] = true;
                $res['data'] = new ProductResource($product);
                $res['message'] = "Product Update Successful!";
            }

        }

        return response()->json($res);
    }


    public function attachCategory(Request $request, $id){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $categories = $request->categories;
        if(count($categories)<=0){
            $res['message'] = 'Please select at least one Category!';
        }else{
            $product = Product::find($id);
            if(!$product){
                $res['message'] = 'Product Not Found!';
            }else{
                $product->categories()->sync($categories);

                $res['status'] = true;
                $res['data'] = new ProductResource($product);
                $res['message'] = 'Category Attached!';
            }
        }
        return response()->json($res);
    }

    public function destroy($id)
    {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $product = Product::find($id);

        if (!$product) {
            $res['message'] = 'Product not found';
        } else {
            if (file_exists(public_path() . "/uploads/images/" . $product->image)) {
                @unlink(public_path() . "/uploads/images/" . $$product->image);
            }

            $resource =new ProductResource($product);
            $product->delete();

            //6. here at the res variable we will give the true inf rather than by default information save at response variable
            $res['status'] = true;
            $res['data'] = $resource;
            $res['message'] = "Product delete Succefull!";
        }
        return response()->json($res);
    }
}
