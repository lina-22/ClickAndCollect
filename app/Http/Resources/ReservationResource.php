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
                'colour' => $p_line->colour,
                'quantity' => $p_line->quantity,
                'size' => $p_line->size,
                'product' => $p_line->product

            ];
            array_push($productLines, $data);
        }


        return [
            'id' => $this->id,
            'dateTime' => $this->dateTime,
            'reference' => $this->reference,
            'status' => $this->status,
            'productLines' => $productLines
        ];
    }
}
