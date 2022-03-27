<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProductAvailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductAvailableController extends Controller
{
    public function showAll()
    {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];
        $productAvailable = ProductAvailable::all();

        if ($productAvailable->count() > 0) {
            $res['status'] = true;
            $res['data'] = $productAvailable;
            $res['message'] = 'This are the available products!';
        } else {
            $res['message'] = 'Products are not avaiable';
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
        $productAvailable = ProductAvailable::find($id);

        if ($productAvailable) {
            $res['status'] = true;
            $res['data'] = $productAvailable;
            $res['message'] = 'This is the available product!';
        } else {
            $res['message'] = 'Product is not avaiable';
        }
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];
        $validator = Validator::make($request->all(), [
            'colour' => 'string',
            'quantity' => 'integer|nullable',
            'size' => 'string|nullable',
            'product_id' => 'required|integer'

        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $productAvailable = new ProductAvailable();
            $productAvailable->colour = $request->colour;
            $productAvailable->quantity = $request->quantity;
            $productAvailable->size = $request->size;
            $productAvailable->product_id = $request->product_id;

            $productAvailable->save();
            $res['status'] = true;
            $res['data'] = $productAvailable;
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
            'colour' => 'string:product_availables',
            'quantity' => 'integer|nullable',
            'size' => 'string|nullable',
            'product_id' => 'required|integer'

        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $productAvailable = ProductAvailable::find($id);

            if (!$productAvailable) {
                $res['message'] = 'product are unabailable';
            } else {
                $productAvailable->colour = $request->colour;
                $productAvailable->quantity = $request->quantity;
                $productAvailable->size = $request->size;
                $productAvailable->product_id = $request->product_id;

                $productAvailable->save();
                $res['status'] = true;
                $res['data'] = $productAvailable;
                $res['message'] = "Product Save Succefull!";
            }
        }
        return response()->json($res);
    }

    public function destroy($id)
    {
        $res = [
            'status' => false,
            'data'  => null,
            'message' => ''
        ];

        $productAvailable = ProductAvailable::find($id);

        if (!$productAvailable) {
            $res['message'] = 'Product is not available!';
        }
        $productAvailable->delete();

        $res['status'] = true;
        $res['data'] = $productAvailable;
        $res['message'] = "Avaiable product deleted succefully!";

        return response()->json($res);
    }
       
}
