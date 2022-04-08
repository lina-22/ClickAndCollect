<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\ProductLine;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductLineController extends Controller
{
    public function store(Request $request)
    {

        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer',
            // 'reservation_id' => 'required|integer',
            'product_available_id' => 'required|integer'
        ]);


        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {
            $user = Auth::user();  //Find Loggedin user//

            if ($user) {
                //Find Previous  Active Reservation
                $reservation = Reservation::where('user_id', $user->id)->where('status', 'Active')->first();

                if ($reservation) {
                    // Reservation is available, Put Product into it,
                    $productLine = $this->createProductLine($request, $reservation);

                    $res['status'] = true;
                    $res['data'] =  new ReservationResource($reservation);
                    $res['message'] = 'Product added to Reservation!';
                } else { //Reservation not found, Create new Reservation
                    $reservation = new Reservation();
                    $reservation->user_id = $user->id;
                    $reservation->reference = "XYZ_ABC";
                    $reservation->status = "Active";
                    $reservation->save();
                    $productLine = $this->createProductLine($request, $reservation);

                    $res['status'] = true;
                    $res['data'] =  new ReservationResource($reservation);
                    $res['message'] = 'Product added to Reservation!';
                }
            } else {
                $res['message'] = 'Un Authorized!!';
            }
        }
        return response()->json($res);
    }

    public function quantityIncrement(Request $request)
    {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $productline_id = $request->productline_id;
        $amount = $request->amount;
        if ($amount) {
            $productLine = ProductLine::find($productline_id);

            if ($productLine) {
                $productLine->quantity = $productLine->quantity + $amount;
                $productLine->save();

                $res['status'] = true;
                $res['data'] =  new ReservationResource($productLine->reservation);
                $res['message'] = 'ProductLine quantity Incremented!';
            } else {
                $res['message'] = 'Product Line not found!';
            }
        }
        return response()->json($res);
    }

    public function quantityDecrement(Request $request)
    {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $productline_id = $request->productline_id;
        $amount = $request->amount;
        if ($amount) {
            $productLine = ProductLine::find($productline_id);

            if ($productLine) {

                if ($productLine->quantity > $amount) {
                    $productLine->quantity = $productLine->quantity - $amount;
                    $productLine->save();

                    $res['status'] = true;
                    $res['data'] =  new ReservationResource($productLine->reservation);
                    $res['message'] = 'ProductLine quantityDecremented!';
                }else{
                    $res['message'] = 'Product quantity is less than amount';
                }
            } else {
                $res['message'] = 'Product Line not found!';
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

        $productLine = ProductLine::find($id);

        if (!$productLine) {
            $res['message'] = 'User is not available!';
        }
        $productLine->delete();

        $res['status'] = true;
        $res['data'] = $productLine;
        $res['message'] = "User deleted succefully!";

        return response()->json($res);
    }

    private function createProductLine($request, $reservation)
    {
        $productLine = new ProductLine();
        $productLine->quantity = $request->quantity;
        $productLine->product_available_id = $request->product_available_id;
        $productLine->reservation_id =  $reservation->id;
        $productLine->save();

        return $productLine;
    }
}

// private function createProductLine($request, , $productAval, $reservation) akany jodi amara $productAval
// name akta variable nai and ata dia 164 no line a product_avaiable_id anar jonno $request
// na dia product_avaiable_id ata k patai ta o tho hoy??  or $request ki amara 164/165/166 ai 3 ta tha e use korta parbo??
// {
//     $productLine = new ProductLine();
//     $productLine->quantity = $request->quantity;
//     $productLine->product_available_id = $request->product_available_id;
//     $productLine->reservation_id =  $reservation->id;
//     $productLine->save();

//     return $productLine;
// }
