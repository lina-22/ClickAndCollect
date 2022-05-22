<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\ProductAvailable;
use App\Models\ProductLine;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductLineController extends Controller
{
    public function showAll()
    {
        $res = [
            'status' => false,
            'data' => null,
            'message' => ''
        ];

        $user = Auth::user(); // Find Loggedin User

        if ($user) {

            // Find Previous Active Reservation
            $reservation = Reservation::where('user_id', $user->id)->where('status', 'Active')->first();

            if ($reservation) { // Reservation is Avialaible
                $res['status'] = true;
                $res['data'] = new ReservationResource($reservation);
                $res['message'] = "Reservation Loaded!";
            } else {
                $res['data'] = [];
                $res['message'] = "No Reservation!";
            }
        } else {
            $res['message'] = "Un Auhorized!";
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
            'quantity' => 'required|integer',
            'product_available_id' => 'required|integer',
            // 'reservation_id' => 'required|integer',
            'product_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $res['message'] = $validator->errors()->first();
        } else {

            $user = Auth::user(); // Find Loggedin User

            if ($user) {

                // Find Previous Active Reservation

                $reservation = Reservation::where('user_id', $user->id)->where('status', 'Active')->first();

                if ($reservation) { // Reservation is Avialaible, Put Product into it,
                    $productLine = $this->createProductLine($request, $reservation);

                    $res['status'] = true;
                    $res['data'] = new ReservationResource($reservation);
                    $res['message'] = "Product Added To Reservation!";
                } else { // Reservation not found, Create new Reservation

                    $reservation = new Reservation();
                    $reservation->user_id = $user->id;
                    $reservation->reference = "CNC_" . time();
                    $reservation->status = 'Active';
                    $reservation->expire_date = Carbon::now()->addDays(3);
                    $reservation->save();
                    $productLine = $this->createProductLine($request, $reservation);

                    $res['status'] = true;
                    $res['data'] = new ReservationResource($reservation);
                    $res['message'] = "Product Added To Reservation!";
                }
            } else {
                $res['message'] = "Un Auhorized!";
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

                $product_available = ProductAvailable::find($productLine->product_available_id);

                if ($product_available->quantity < $amount) {
                    $res['message'] = 'Product Amount Not Available!';
                } else {
                    $product_available->quantity = $product_available->quantity -  $amount;
                    $product_available->save();

                    $productLine->quantity = $productLine->quantity + $amount;
                    $productLine->save();

                    $res['status'] = true;
                    $res['data'] = new ReservationResource($productLine->reservation);
                    $res['message'] = "ProductLine Quantity Incremented!";
                }
            } else {
                $res['message'] = 'Product Line Not Found!';
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
        $product_id = $request->product_id;
        $amount = $request->amount;
        if ($amount) {
            $productLine = ProductLine::find($productline_id);

            if ($productLine) {
                $product_available = ProductAvailable::find($productLine->product_available_id);

                if ($productLine->quantity > $amount) {

                    $product_available->quantity = $product_available->quantity +  $amount;
                    $product_available->save();

                    $productLine->quantity = $productLine->quantity - $amount;
                    $productLine->save();

                    $res['status'] = true;
                    $res['data'] = new ReservationResource($productLine->reservation);
                    $res['message'] = "ProductLine Quantity Decremented!";
                } else {
                    $res['message'] = 'Quantity is less than Decrement Amount!';
                }
            } else {
                $res['message'] = 'Product Line Not Found!';
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
        $productLine = ProductLine::find($id);

        if (!$productLine) {
            $res['message'] = 'ProductLine not found';
        } else {

            $data = $productLine->reservation;

            $product_available = ProductAvailable::find($productLine->product_available_id);

            $product_available->quantity = $product_available->quantity +  $productLine->quantity;
            $product_available->save();

            $productLine->delete();

            //6. here at the res variable we will give the true inf rather than by default information save at response variable
            $res['status'] = true;
            $res['data'] = new ReservationResource($data);
            $res['message'] = "ProductLine delete Succefull!";
        }
        return response()->json($res);
    }

    private function createProductLine($request, $reservation)
    {
        $productLine = ProductLine::where('reservation_id', $reservation->id)->where('product_available_id', $request->product_available_id)->first();
        $product_available = ProductAvailable::find($request->product_available_id);

        if ($productLine) {
            $product_available->quantity = $product_available->quantity -  $request->quantity;
            $product_available->save();

            $productLine->quantity = $productLine->quantity + $request->quantity;
            $productLine->save();
        } else {

            $product_available->quantity = $product_available->quantity -  $request->quantity;
            $product_available->save();

            $productLine = new ProductLine();
            $productLine->quantity = $request->quantity;
            $productLine->product_available_id = $request->product_available_id;
            $productLine->product_id = $request->product_id;
            $productLine->reservation_id = $reservation->id;
            $productLine->save();
        }

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

