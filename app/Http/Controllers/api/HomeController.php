<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index(){


    $products = Product::where('is_featured', 1)->get();
    $categories = Category::where('is_featured', 1)->get();

    return[
        'status' => true,
        'data' => [
            'products' => ProductResource::collection($products),
            'categories' => $categories
        ],
        'message' => 'Success'
    ];
   }
}
