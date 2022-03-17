<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{

    public function store(Request $request){
  
        // here from 14 lines until 19 lines by dafault shift/alt/A by this way alo can comment
        $res = [
            'status' =>false,
            'data' => null,
            'message' => ''
        ];

       /*  name eand image validation  */ 
        $validator = Validator::make($request->all(),[
            'name' =>'required|string|unique:categories',
            'image' => 'image|nullable|sometimes']);

      /* for name  */      
      if($validator->fails()){
        $res['message'] = $validator->errors()->first();
    }else{
        $category = new Category();
        $category->name = $request->name;

    /*  this lines 36 until 41 for image  */
     if ($image_file = $request->file('image')){
         $extension = $image_file->getClientoriginalExtension();
         $image = 'Category_'.time().'.'.$extension;
         Image::make($image_file)->save(public_path().":uploads:images".$image);
         $category->image = $image;  
       }
       $category->save();
       $res['status'] = true;
       $res['data'] = $category;
       $res['message'] = "Category Save Successful!";
   }
    return response()->json($res);
    }
}

/* Integration in Laravel two steps config/app and at teh facade $aliases */
