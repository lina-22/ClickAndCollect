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

            $data = [
                'id' => $p_line->id,
                'colour' => $p_line->proAvl->colour,
                'quantity' => $p_line->quantity,
                'size' => $p_line->proAvl->size,
                'product' => $p_line->product,
                'totalPrice' =>  round($p_line->product->price - $p_line->product->price * $p_line->product->discount / 100, 2) * $p_line->quantity

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
