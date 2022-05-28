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
        $productLines = [];
        foreach ($this->productLines as $p_line) {
            //dd($p_line);
            $data = [
                'reservation_id'=>$this->id,
                'product_available_id'=> $p_line->id,
                'colour' => $p_line->colour,
                'quantity' => $p_line->pivot->quantity,
                'size' => $p_line->size,
                'product' => $p_line->products,
                'totalPrice' =>  round($p_line->products->price - $p_line->products->price * $p_line->products->discount / 100, 2) * $p_line->pivot->quantity

            ];
            array_push($productLines, $data);
        }


        return [
            'id' => $this->id,
            'dateTime' => $this->dateTime,
            'reference' => $this->reference,
            'status' => $this->status,
            'expire_date' => $this->expire_date,
            'productLines' => $productLines
        ];
    }
}
