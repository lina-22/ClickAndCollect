<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $productAvailables =[];
       foreach ($productAvailables as $productAvailable){
           $data = [
                    'id' => $productAvailable->id,
                    'colour' => $productAvailable->colour,
                    'quantity' => $productAvailable->quantity,
                    'size' => $productAvailable->size

           ];
       }
       array_push($productAvailables, $data);
         
        return [
            'id' =>$this->id,
            'dateTime'=>$this->dateTime,
            'reference'=>$this->reference,
            'status'=>$this->reference,
            'ProductAvailable' => $productAvailables
        ];
    }
}
