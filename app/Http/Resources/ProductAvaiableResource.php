<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductAvaiableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $reservations = [];
        foreach($this->reservations as $reservation){
            $data = [
               'id'=> $reservation->id,
               'dateTime' => $reservation->dateTime,
               'reference' => $reservation->reference,
               'status' => $reservation->status
            ];
            array_push($reservations, $data);
        }

        
        return [
            'id'=>$this->id,
            'color'=>$this->colour,
            'quantity' =>$this->quantity,
            'size' =>$this->quantity,
            'reservations'=>$reservations
        ];
    }
}
