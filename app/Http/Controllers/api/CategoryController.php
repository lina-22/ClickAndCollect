<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{
    public function showAll()
     {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $categories = Category::all();

        if ($categories->count() > 0) {
            $res['status'] = true;
            $res['data'] = $categories;
            $res['message'] = 'Category Load Success!';
        } else {
            $res['message'] = 'no category found';
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

        $category = Category::find($id);
        // amra vabe category thake products a na giya data ar maje category resource ar vitora $category dia dibo
        // $category->products;

        if ($category) {
            $res['status'] = true;
            $res['data'] = new CategoryResource($category);
            $res['message'] = 'Category Load Success!';
        } else {
            $res['message'] = 'category not found';
        }

        return response()->json($res);
    }

    public function store(Request $request)
     {

          // dd($request->all());
        //1.  here by default information save at response variable
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        // here end of the by default information save at response variable

        //  2.what kinds of things we are going to valided

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories',
            'image' => 'image|nullable|sometimes' /*1. this line should delete as we will cut cat images  total 7 lines*/
        ]);

        //  end what kinds of things we are going to valided

        // 3. start to verify the name with validation
        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->is_featured = $request->is_featured; /*2.this line should delete as we will cut cat images */

            // end to verify the name with validation

            // 4.  this lines for image /*this line should delete as we will cut cat images */

            if ($image_file = $request->file('image')) {
                $extension = $image_file->getClientOriginalExtension();
                $image = 'Category_' . time() . '.' . $extension;
                Image::make($image_file)->save(public_path() . "/uploads/images/" . $image);
                $category->image = $image;
            }

            //  end lines for image /*this line should delete as we will cut cat images */

            // 5. we need to save the category variable
            $category->save();

            // ** i write this line after make the relationship between many to many(Postman a arry akara jeta dekcilam ata akany add kora dicy)
            $category->products()->sync($request->products);
            //6. here at the res variable we will give the true inf rather than by default information save at response variable
            $res['status'] = true;
            $res['data'] = $category;
            $res['message'] = "Category Save Succefull!";

            // here end of the res variable
        }

        // 7. finally return the Json data

        return response()->json($res);
    }


    public function update(Request $request, $id)
     {
        //1.  here by default information save at response variable
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        // here end of the by default information save at response variable
        //  2.what kinds of things we are going to valided

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|nullable|sometimes' /*this line should delete as we will cut cat images */
        ]);

        //  end what kinds of things we are going to valided
      // 3. start to verify the name with validation
        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $category = Category::find($id);

            if (!$category) {
                $res['message'] = 'Category not found';
            } else {
                $category->name = $request->name;
                $category->is_featured = $request->is_featured; /*this line should delete as we will cut cat images */

                // end to verify the name with validation

                // 4.  this lines for image
               /*this line should delete as we will cut cat images */
                if ($image_file = $request->file('image')) {
                    if (file_exists(public_path() . "/uploads/images/" . $category->image)) {
                        @unlink(public_path() . "/uploads/images/" . $category->image);
                    }
                    $extension = $image_file->getClientOriginalExtension();
                    $image = 'Category_' . time() . '.' . $extension;
                    Image::make($image_file)->save(public_path() . "/uploads/images/" . $image);
                    $category->image = $image;
                }
               /*this line should delete as we will cut cat images */
                //  end lines for image

                // 5. we need to save the category variable
                $category->save();

                //6. here at the res variable we will give the true inf rather than by default information save at response variable
                $res['status'] = true;
                $res['data'] = $category;
                $res['message'] = "Category Update Succefull!";

                // here end of the res variable
            }

            // 7. finally return the Json data


        }
        return response()->json($res);

    }

    public function destroy($id){
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];
        $category = Category::find($id);

        if (!$category) {
            $res['message'] = 'Category not found';
        } else { /*this line should delete as we will cut cat images */
            if (file_exists(public_path() . "/uploads/images/" . $category->image)) {
                @unlink(public_path() . "/uploads/images/" . $category->image);
            }
            $category->delete();

            //6. here at the res variable we will give the true inf rather than by default information save at response variable
            $res['status'] = true;
            $res['data'] = $category;
            $res['message'] = "Category delete Succefull!";

        }
        return response()->json($res);
    }
}


