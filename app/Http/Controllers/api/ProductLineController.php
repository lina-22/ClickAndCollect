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
