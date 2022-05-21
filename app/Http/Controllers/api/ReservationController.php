<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    public function showAll(){
        $res=[
           'status' => false,
           'data' => null,
           'message' => ''
        ];

        $reservations = Reservation::all();
        if($reservations->count()>0){
           $res['status'] = true;
           $res['data'] = ReservationResource::collection($reservations);
           $res['message'] = 'Reservations Loading Successfully';
        }
        else{
            $res['message'] = 'There dont have any reservation for the moments!';
        }
        return response()->json($res);
      }

      public function showSingle($id){
          $res = [
              'status' => false,
              'data' => null,
              'message' => ''
          ];

          $reservation = Reservation::find($id);
          if ($reservation){
              $res['status'] = true;
              $res['data'] = new ReservationResource($reservation);
              $res['message'] = 'This is your reserved item!';
          }else{
              $res['message'] = 'There is no reservation for you!';
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
          $validator = Validator::make($request->all(),[
              'reference' => 'string|unique:reservations',
              'status' => 'string'
          ]);
          if ($validator->fails()){
              $res['message'] = $validator->errors()->first();
          }else{
              $reservation = new Reservation();
              $reservation->reference = $request->reference;
              $reservation->status = $request->status;

              $reservation-> save();
              $reservation->productAvailable()->sync($request->productAvailables);
              $res['status'] = 'true';
              $res['data'] = '$reservation';
              $res['message'] = 'Reservation saved successfully!';
          }
             return response()->json($res);

      }

      public function update(Request $request, $id){
          $res = [
              'status' => false,
              'data' => null,
              'message' => ''
          ];
          $validator = Validator::make($request->all(),[
              'reference' => 'string|unique:reservations',
              'status' => 'string'
          ]);
          if ($validator->fails()){
              $res['message'] = $validator->errors()->first();
          }else{
              $reservation = Reservation::find($id);
              if(!$reservation){
                  $res['message'] = "reservation not found";
              } else{
              $reservation->reference = $request->reference;
              $reservation->status = $request->status;

              $reservation-> save();
              $res['status'] = 'true';
              $res['data'] = '$reservation';
              $res['message'] = 'Reservation saved successfully!';
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
          $reservation = Reservation::find($id);

          if(!$reservation){
              $res['message'] = 'reservation is not available!';
          }
          $reservation->delete();

          $res['status'] = true;
          $res['data'] = $reservation;
          $res['message'] = "Reserved product deleted succefully!";

          return response()->json($res);
      }
}
